<?php
class PengurusModel{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    private function isAnggotaAlreadyPengurus($anggota_id) {
        $query = "SELECT COUNT(*) FROM pengurus WHERE anggota_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $anggota_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    private function isAnggotaDuplicateOnUpdate($id, $anggota_id) {
        $query = "SELECT COUNT(*) FROM pengurus WHERE anggota_id = ? AND id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $anggota_id, $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    private function isJabatanDuplicateOnUpdate($id, $divisi_id, $jabatan) {
        // Cek pengurus lain (WHERE id != ?) yang memiliki divisi_id DAN jabatan yang sama
        $query = "SELECT COUNT(*) FROM pengurus WHERE divisi_id = ? AND jabatan = ? AND id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isi", $divisi_id, $jabatan, $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }
    private function isJabatanDuplicate($divisi_id, $jabatan) {
        $query = "SELECT COUNT(*) FROM pengurus WHERE divisi_id = ? AND jabatan = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $divisi_id, $jabatan);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public function getAllPengurus() {
        $query = "SELECT 
                    p.id, 
                    p.anggota_id, 
                    p.divisi_id, 
                    p.jabatan,
                    a.nama AS nama_anggota,       -- Kolom yang hilang
                    d.nama_divisi                 -- Kolom yang hilang
                FROM 
                    pengurus p
                JOIN 
                    anggota a ON p.anggota_id = a.id
                JOIN 
                    divisi d ON p.divisi_id = d.id
                ORDER BY 
                    divisi_id ASC";
        
        return $this->conn->query($query);
    }

    public function getPengurusById($id){
        $query = "SELECT * FROM pengurus WHERE id = $id";
        return $this->conn->query($query)->fetch_assoc();
    }

    public function createPengurus ($anggota_id, $divisi_id, $jabatan){
        if ($this->isAnggotaAlreadyPengurus($anggota_id)) {
            return "Error: Anggota ini sudah terdaftar sebagai pengurus."; 
        }

        if ($this->isJabatanDuplicate($divisi_id, $jabatan)) {
            return "Error: Jabatan '{$jabatan}' di divisi ini sudah terisi."; 
        }
        $query = "INSERT INTO pengurus
                    (anggota_id, divisi_id, jabatan)
                VALUES
                    ('$anggota_id','$divisi_id','$jabatan')";
        return $this->conn->query($query);
    }

    public function updatePengurus ($id, $anggota_id, $divisi_id, $jabatan){
        if ($this->isAnggotaDuplicateOnUpdate($id, $anggota_id)) {
            return "Error: Anggota ini sudah menjabat posisi pengurus lain."; 
        }

        if ($this->isJabatanDuplicateOnUpdate($id, $divisi_id, $jabatan)) {
            return "Error: Jabatan '{$jabatan}' di divisi ini sudah terisi oleh orang lain."; 
        }    
        $query = "UPDATE pengurus SET
                    anggota_id = ?,
                    divisi_id = ?,
                    jabatan = ?
                WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisi", $anggota_id, $divisi_id, $jabatan, $id); 
        $result = $stmt->execute();
        $stmt->close();

        // Logika pengembalian yang disederhanakan dan lebih aman:
        if ($result) {
            return true; // Berhasil eksekusi query (apakah ada perubahan data atau tidak, dianggap sukses)
        }
        return "Error: Gagal menyimpan ke database."; // Error DB

    }

    public function deletePengurus($id){
        $query = "DELETE FROM pengurus WHERE id = $id";
        return $this->conn->query($query);
    }

    public function getAllDivisi(){
        $query = "SELECT id, nama_divisi FROM divisi";
        return $this->conn->query($query);
    }
    public function getAllAnggota(){
        $query = "SELECT id, nama FROM anggota";
        return $this->conn->query($query);
    }    
}