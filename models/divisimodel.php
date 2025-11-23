<?php
class DivisiModel {
    private $conn;

    public function __construct ($db){
        $this->conn = $db;
    }

    public function getAllDivisi(){
        $query ="SELECT
                    id,
                    nama_divisi,
                    deskripsi
                FROM divisi
                 ORDER BY id ASC";
        return $this->conn->query($query);
    }

    public function getDivisiById($id){
        $sql ="SELECT * FROM divisi WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function createDivisi ($nama_divisi, $deskripsi){
        $query ="INSERT INTO divisi 
                    (nama_divisi, deskripsi) 
                VALUES
                    ('$nama_divisi','$deskripsi')";
        return $this->conn->query($query);
    }

    public function updateDivisi ($id, $nama_divisi, $deskripsi){
        $query = "UPDATE divisi SET nama_divisi=?, deskripsi=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $nama_divisi, $deskripsi, $id); 
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function deleteDivisi($id){
        $query = "DELETE FROM divisi WHERE id = $id";
        return $this->conn->query($query);
    }

    public function getAllAngggota(){
        $query = "SELECT id, nama FROM anggota ORDER BY nama ASC";
        return $this->conn->query($query);
    }
}
?>