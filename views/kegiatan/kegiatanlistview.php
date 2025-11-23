<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Asumsikan --color-biru-aksen adalah variabel CSS yang didefinisikan di tempat lain */
        .action-links a.primary-link { background-color: #007bff; color: white; } /* Default blue */
        .action-links a.primary-link:hover { background-color: #0056b3; }
        /* Pastikan style.css sudah memiliki .edit, .delete, dan .action-links */
    </style>
</head>
<body>

    <div class="navbar">
        <img src="assets/logo.png" alt="MBGWB Connect Logo" class="navbar-logo">
        <nav>
            <ul>
                <li><a href="index.php?page=dashboard">Dashboard</a></li>
                <li><a href="index.php?page=anggota">Anggota</a></li>
                <li><a href="Index.php?page=pengurus">Pengurus</a></li>
                <li><a href="index.php?page=divisi">Divisi</a></li>
                <li><a href="index.php?page=kegiatan" class="active">Kegiatan</a></li>
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
            <h1>Daftar Kegiatan</h1>
            <?php if ($role_id != 2 && $role_id!=3) { ?>
            <a class="action-button primary" href="index.php?page=kegiatan&action=create">Tambah Kegiatan</a>
            <?php } ?>
            <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Divisi</th>
                        <th>Nama Kegiatan</th>
                        <th>Penanggung Jawab</th>
                        <th>Tempat</th>
                        <th>Status Pelaksanaan</th>
                        <?php if ($role_id != 3) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($result) && is_object($result) && method_exists($result, 'data_seek')) {
                        $result->data_seek(0); 
                    }
                    $no=1;
                    if (isset($result) && is_object($result) && method_exists($result, 'fetch_assoc')) {
                        while($row = $result->fetch_assoc()){
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_divisi']}</td>
                                <td>{$row['nama_kegiatan']}</td>
                                <td>{$row['pj_nama']}</td>
                                <td>{$row['tempat']}</td>
                                <td>{$row['status_kegiatan']}</td>";
                                
                            // Logika Aksi Disederhanakan dan Diperbaiki
                            if ($role_id != 3) {
                                echo "<td class='action-links'>";
                                
                                // Tombol Edit dan Absen tersedia jika role_id bukan 3
                                echo "
                                    <a class='action-link edit' href='index.php?page=kegiatan&action=edit&id={$row['id']}'>Edit</a>
                                    <a class='action-link absensi' href='index.php?page=kegiatan&action=formAbsensi&id={$row['id']}'>Absensi</a>
                                    <a class='action-link keuangan' href='index.php?page=kegiatan&action=listKeuangan&id={$row['id']}'>Keuangan</a>";
                                if ($role_id != 2) { 
                                    echo "
                                    <a class='action-link delete' href='index.php?page=kegiatan&action=delete&id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>";
                                }

                                echo "</td>";
                            }
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