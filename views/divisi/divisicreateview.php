<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Divisi Baru - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
    
    <div class="navbar">
        <img src="assets/logo.png" alt="MBGWB Connect Logo" class="navbar-logo">
        <nav>
            <ul>
                <li><a href="index.php?page=dashboard">Dashboard</a></li>
                <li><a href="index.php?page=anggota">Anggota</a></li>
                <li><a href="Index.php?page=pengurus">Pengurus</a></li>
                <li><a href="index.php?page=divisi" class="active">Divisi</a></li>
                <li><a href="index.php?page=kegiatan">Kegiatan</a></li>
                <li><a href="index.php?page=inventaris">Inventaris</a></li>
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
        <div class="container-create-edit">
            <h1>Tambah Divisi Baru</h1>

            <form method="post" action="index.php?page=divisi&action=create" class="data-form">
                
                <div class="form-group">
                    <label for="nama_divisi">Nama Divisi</label>
                    <input type="text" id="nama_divisi" name="nama_divisi" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit">💾 Simpan</button>
                    <a href="index.php?page=divisi&action=list">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>