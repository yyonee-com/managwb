<?php
class KeuanganModel {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAllkeuanganByKegiatan ($kegiatan_id){
        $kegiatan_id_esc = $this->conn->real_escape_string($kegiatan_id);
        $sql = "SELECT 
                    id, kegiatan_id, jenis_transaksi, deskripsi, jumlah, tanggal_transaksi
                FROM 
                    keuangan 
                WHERE 
                    kegiatan_id = '$kegiatan_id_esc' 
                ORDER BY 
                    tanggal_transaksi ASC, id ASC";
        
        $result = $this->conn->query($sql);
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows; 
    }

    public function getRekapKeuanganByKegiatan ($kegiatan_id){
        $kegiatan_id_esc = $this->conn->real_escape_string($kegiatan_id);
        $sql = "SELECT 
                    jenis_transaksi, 
                    SUM(jumlah) as total
                FROM 
                    keuangan
                WHERE 
                    kegiatan_id = '$kegiatan_id_esc' 
                GROUP BY 
                    jenis_transaksi";

        $result = $this->conn->query($sql);
        $rekap = [
            'Pemasukan' => 0,
            'Pengeluaran' => 0
        ];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (isset($rekap[$row['jenis_transaksi']])) {
                     $rekap[$row['jenis_transaksi']] = (float)$row['total'];
                }
            }
        }
        $rekap['Saldo'] = $rekap['Pemasukan'] - $rekap['Pengeluaran'];       
        return $rekap; 
    }

    public function createkeuangan($kegiatan_id, $jenis_transaksi, $deskripsi, $jumlah, $tanggal_transaksi) {
        $kegiatan_id_esc = $this->conn->real_escape_string($kegiatan_id);
        $jenis_transaksi = strtolower($jenis_transaksi);
        $jenis_transaksi_esc = $this->conn->real_escape_string($jenis_transaksi);
        $deskripsi_esc = $this->conn->real_escape_string($deskripsi);
        $tanggal_transaksi_esc = $this->conn->real_escape_string($tanggal_transaksi);
        $jumlah_esc = number_format((float)abs($jumlah), 2, '.', '');
        $sql = "INSERT INTO keuangan 
                    (kegiatan_id, jenis_transaksi, deskripsi, jumlah, tanggal_transaksi)
                VALUES (
                    '$kegiatan_id_esc', 
                    '$jenis_transaksi_esc', 
                    '$deskripsi_esc', 
                    '$jumlah_esc',
                    '$tanggal_transaksi_esc'
                )";
        
        return $this->conn->query($sql);
    }

    public function updatekeuangan($transaksi_id, $kegiatan_id, $tanggal, $jenis_transaksi, $jumlah, $deskripsi) {
        $transaksi_id_esc = $this->conn->real_escape_string($transaksi_id);
        $jenis_transaksi = strtolower($jenis_transaksi);
        $jenis_transaksi_esc = $this->conn->real_escape_string($jenis_transaksi);
        $jenis_transaksi_esc = $this->conn->real_escape_string($jenis_transaksi);
        $deskripsi_esc = $this->conn->real_escape_string($deskripsi);
        $tanggal_esc = $this->conn->real_escape_string($tanggal);
    
        $jumlah_esc = number_format((float)abs($jumlah), 2, '.', ''); 
        $sql = "UPDATE keuangan SET 
                    kegiatan_id = '$kegiatan_id_esc',
                    tanggal_transaksi = '$tanggal_esc',
                    jenis_transaksi = '$jenis_transaksi_esc',
                    jumlah = '$jumlah_esc',
                    deskripsi = '$deskripsi_esc'
                WHERE 
                    id = '$transaksi_id_esc'";
        
        return $this->conn->query($sql);
    }
    public function deletekeuangan($transaksi_id) {
    $transaksi_id_esc = $this->conn->real_escape_string($transaksi_id);
    $sql = "DELETE FROM keuangan WHERE id = '$transaksi_id_esc'";
    
    return $this->conn->query($sql);
    }
}
?>