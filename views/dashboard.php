<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || !isset($_SESSION['user']['nama'])) {
    header('Location: index.php?page=login');
    exit();
}

$user = $_SESSION['user'];
$roleName = "Pengguna";
if (isset($user['role_id'])) {
    switch ($user['role_id']) {
        case 1:
            $roleName = "Admin";
            break;
        case 2:
            $roleName = "Penanggung Jawab";
            break;
        case 3:
            $roleName = "Anggota";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="navbar">
        <img src="assets/logo.png" alt="MBGWB Connect Logo" class="navbar-logo">
        <nav>
            <ul>
                <li><a href="index.php?page=dashboard" class="active">Dashboard</a></li>
                <?php if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3): ?>
                    <li><a href="index.php?page=anggota">Anggota</a></li>
                    <li><a href="Index.php?page=pengurus">Pengurus</a></li>
                    <li><a href="index.php?page=divisi">Divisi</a></li>
                    <li><a href="index.php?page=kegiatan">Kegiatan</a></li>
                    <li><a href="index.php?page=inventaris">Inventaris</a></li>
                <?php endif; ?>
                <li>
                    <a href="index.php?page=logout" 
                    onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                     Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    <div class="main-content">
        <div class="container-das">
            <h1>Dashboard</h1>
            
            <div class="alert">
                Selamat datang, <?php echo htmlspecialchars($user['nama']); ?>! Anda login sebagai <?php echo $roleName; ?>.
            </div>
            <div class="user-info">
                <h3>Informasi Akun:</h3>
                <p><strong>Nama:</strong> <?php echo htmlspecialchars($user['nama']); ?></p>
                <p><strong>Peran:</strong> <?php echo $roleName; ?></p>
            </div>
        </div>
    </div>
</body>
</html>