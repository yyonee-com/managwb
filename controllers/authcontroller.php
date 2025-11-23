<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/user.php';

class AuthController {
    public function showLogin($error = null) {
        require_once __DIR__ . '/../views/login.php'; 
    }
    public function login() {
        $error = '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = "Username dan Password tidak boleh kosong.";
            return $this->showLogin($error);
        }

        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);

        if ($user->login($username, $password)) {
            
            $_SESSION['user'] = [
                'id' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'role_id' => $user->role_id
            ];
            header("Location: index.php?page=dashboard");
            exit();

        } else {
            $error = "Username atau Password salah. Silakan coba lagi.";
            return $this->showLogin($error);
        }
    }
}
