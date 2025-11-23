<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Inventaris - Sistem Informasi</title>
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
                <li><a href="index.php?page=divisi" >Divisi</a></li>
                <li><a href="index.php?page=kegiatan">Kegiatan</a></li>
                <li><a href="index.php?page=inventaris" class="active">Inventaris</a></li>
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
            <h1>Daftar Inventaris</h1>

            <?php if ($role_id != 3) { ?>
                <a class="action-button primary" href="index.php?page=inventaris&action=create">Tambah Inventaris</a>
            <?php } ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Lokasi Penyimpanan</th>
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
                        
                        $no = 1;
                        if (isset($result) && is_object($result) && method_exists($result, 'fetch_assoc')) {
                            while ($row = $result->fetch_assoc()) {
                                echo"
                                <tr>
                                    <td>{$no}</td>
                                    <td>{$row['nama_produk']}</td>
                                    <td>{$row['jumlah']}</td>
                                    <td>{$row['kondisi']}</td>
                                    <td>{$row['lokasi_penyimpanan']}</td>";
                                    
                                if ($role_id!=3){
                                    echo"<td class='action-links'>
                                            <a class='action-link edit' href='index.php?page=inventaris&action=edit&id={$row['id']}'>Edit</a>
                                            <a class='action-link delete' href='index.php?page=inventaris&action=delete&id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
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