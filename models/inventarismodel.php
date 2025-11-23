<?php
class InventarisModel{
    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }

    public function getAllInventaris(){
        $query ="SELECT id, nama_produk, jumlah, kondisi, lokasi_penyimpanan
                FROM inventaris
                ORDER BY nama_produk ASC";
        return $this->conn->query($query);
    }

    public function getInventarisById($id){
        $sql ="SELECT*FROM inventaris WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows>0){
            return $result->fetch_assoc();
        }
        return null;
    }

    public function createInventaris ($nama_produk, $jumlah, $kondisi, $lokasi_penyimpanan){
        $query = "INSERT INTO inventaris
                    (nama_produk, jumlah, kondisi, lokasi_penyimpanan)
                VALUES
                    ('$nama_produk','$jumlah','$kondisi','$lokasi_penyimpanan')";
                return $this->conn->query($query);
    }

    public function updateInventaris($id, $nama_produk, $jumlah, $kondisi, $lokasi_penyimpanan){
        $query = "UPDATE inventaris SET
                    nama_produk=?,
                    jumlah=?,
                    kondisi=?,
                    lokasi_penyimpanan=?
                WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $nama_produk, $jumlah, $kondisi, $lokasi_penyimpanan, $id);
        $succes = $stmt->execute();
        $stmt->close();
        return $succes;
    }

    public function deleteInventaris($id){
        $query = "DELETE FROM inventaris WHERE id=$id";
        return $this->conn->query($query);
    }
}
?>