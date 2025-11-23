<?php
class KegiatanModel{
    private $conn;

    public function __construct($db){
        $this->conn =$db;
    }
    public function getAllKegiatan(){
        $query ="SELECT 
                    a.id, a.nama_kegiatan, a.tempat, a.status_kegiatan, d.nama_divisi, p.nama AS pj_nama 
                    FROM kegiatan a 
                    JOIN divisi d ON a.divisi_id = d.id
                    JOIN anggota p ON a.penanggung_jawab_id = p.id
                    ORDER BY nama_kegiatan ASC";
        return $this->conn->query($query);
    }

    public function getKegiatanById($id){
        $query = "SELECT * FROM kegiatan WHERE id = $id";
        return $this->conn->query($query)->fetch_assoc();
    }

    public function createKegiatan($divisi_id, $nama_kegiatan, $penanggung_jawab_id, $tempat, $status_kegiatan){
        $query = "INSERT INTO kegiatan 
                    (divisi_id, nama_kegiatan, penanggung_jawab_id, tempat, status_kegiatan)
                VALUES
                    ('$divisi_id','$nama_kegiatan','$penanggung_jawab_id','$tempat','$status_kegiatan')";
        return $this->conn->query($query);
    }

    public function updateKegiatan ($id, $divisi_id, $nama_kegiatan, $penanggung_jawab_id, $tempat, $status_kegiatan){
        $query = "UPDATE kegiatan SET
                    divisi_id = '$divisi_id',
                    nama_kegiatan = '$nama_kegiatan',
                    penanggung_jawab_id = '$penanggung_jawab_id',
                    tempat = '$tempat',
                    status_kegiatan = '$status_kegiatan'
                WHERE id = $id";
        return $this->conn->query($query);
    }

    public function deleteKegiatan($id){
        $query = "DELETE FROM kegiatan WHERE id = $id";
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
?>