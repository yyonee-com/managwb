<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Divisi - Sistem Informasi</title>
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
        <div class="container"> 
            <h1>Daftar Divisi</h1>

            <?php if ($role_id != 2 && $role_id!=3) { ?>
                <a class="action-button primary" href="index.php?page=divisi&action=create">Tambah Divisi</a>
            <?php } ?>

            <div class="table-responsive">
                <table class="data-table"> 
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Divisi</th>
                            <th>Deskripsi</th>
                            <?php if ($role_id != 2 && $role_id!=3) { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Diasumsikan $result sudah didefinisikan dan berisi hasil query database
                        if (isset($result) && is_object($result) && method_exists($result, 'data_seek')) {
                            $result->data_seek(0); 
                        }
                        
                        $no = 1;
                        if (isset($result) && is_object($result) && method_exists($result, 'fetch_assoc')) {
                            while ($row = $result->fetch_assoc()){

                                echo "
                                <tr>
                                    <td>{$no}</td>
                                    <td>{$row['nama_divisi']}</td>
                                    <td>{$row['deskripsi']}</td>";
                                
                                if ($role_id !=2 && $role_id!=3){
                                    echo"
                                    <td class='action-links'>
                                        <a class='action-link edit' href='index.php?page=divisi&action=edit&id={$row['id']}'>Edit</a>
                                        <a class='action-link delete' href='index.php?page=divisi&action=delete&id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                                    </td>";}
                                echo "</tr>";
                                $no++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
    </div>

</body>
</html>