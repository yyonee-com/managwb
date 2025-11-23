<?php
class User {
    private $conn;
    private $table = "anggota";

    public $id;
    public $nama;
    public $username;
    public $password;
    public $role_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            if ($password === $user['password']) {
                $this->id = $user['id'];
                $this->nama = $user['nama'];
                $this->username = $user['username'];
                $this->role_id = $user['role_id'];
                return true;
            }
        }
        return false;
    }
}
