<?php
class AbsensiModel {
    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }

    public function getRekapAbsensiByKegiatan ($kegiatan_id){
        $kegiatan_id_esc = $this->conn->real_escape_string($kegiatan_id);
        $sql = "SELECT DISTINCT tanggal_absensi FROM absensi WHERE kegiatan_id = '$kegiatan_id_esc' ORDER BY tanggal_absensi DESC";
        
        $result = $this->conn->query($sql);
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows; 
    }

    public function getAbsensiDetailByDate ($kegiatan_id, $tanggal){
        // Pembersihan input
        $kegiatan_id_esc = $this->conn->real_escape_string($kegiatan_id);
        $tanggal_esc = $this->conn->real_escape_string($tanggal);

        $sql ="SELECT 
                a.id as anggota_id, a.username, a.nama,
            IFNULL
                (b.status_kehadiran, 'belum_absen') 
            as 
                status_kehadiran
            FROM anggota a LEFT JOIN absensi b 
            ON a.id = b.anggota_id 
            AND b.kegiatan_id = '$kegiatan_id_esc' 
            AND b.tanggal_absensi = '$tanggal_esc'
            ORDER BY nama ASC";

        $result = $this->conn->query($sql);
        
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows; // Selalu kembalikan array
    }

    public function catatAbsensi($kegiatan_id, $tanggal_absensi, $data_absensi) {
        $success = true;
        
        $kegiatan_id_esc = $this->conn->real_escape_string($kegiatan_id);
        $tanggal_absensi_esc = $this->conn->real_escape_string($tanggal_absensi);

        foreach ($data_absensi as $anggota_id => $data) {
            
            $anggota_id_esc = $this->conn->real_escape_string($anggota_id);
            $status = $this->conn->real_escape_string($data['status_kehadiran']);
            // Kolom $keterangan dihapus

            // Gunakan `REPLACE INTO` untuk INSERT/UPDATE tanpa kolom keterangan
            $sql = "REPLACE INTO absensi 
                    (kegiatan_id, tanggal_absensi, anggota_id, status_kehadiran)
                    VALUES (
                        '$kegiatan_id_esc', 
                        '$tanggal_absensi_esc', 
                        '$anggota_id_esc', 
                        '$status'
                    )";
            
            if (!$this->conn->query($sql)) {
                $success = false;
            }
        }
        return $success;
    }
}
?>