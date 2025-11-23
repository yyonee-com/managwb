<?php
class AnggotaModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

public function getAllAnggota() {
    $query = "SELECT 
                a.id, 
                a.nama, 
                a.username, 
                a.password, 
                a.jenis_kelamin, 
                a.no_hp, 
                a.alamat, 
                a.role_id, 
                r.role_name     
            FROM 
                anggota a
            JOIN 
                roles r ON a.role_id = r.id   
            ORDER BY nama ASC";
    
    return $this->conn->query($query);
}

    public function getAnggotaById($id) {
        $sql = "SELECT * FROM anggota WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function createAnggota($nama, $username, $password, $jk,$no_hp, $alamat, $role_id) {
        $query = "INSERT INTO anggota 
                    (nama, username, password, jenis_kelamin,  no_hp, alamat, role_id)
                VALUES 
                    ('$nama', '$username', '$password', '$jk', '$no_hp', '$alamat', '$role_id')";
        return $this->conn->query($query);
    }

    public function updateAnggota($id, $nama, $username, $password, $jk, $no_hp, $alamat, $role_id) {
        $query = "UPDATE anggota SET 
                    nama=?, 
                    username=?,
                    password=?,
                    jenis_kelamin=?, 
                    no_hp=?, 
                    alamat=?, 
                    role_id=?
                WHERE id=?";
                
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssi", 
            $nama, 
            $username, 
            $password, 
            $jk, 
            $no_hp, 
            $alamat, 
            $role_id,   
            $id         
        ); 
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function deleteAnggota($id) {
        $query = "DELETE FROM anggota WHERE id = $id";
        return $this->conn->query($query);
    }
}

?>
