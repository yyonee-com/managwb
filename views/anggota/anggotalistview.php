<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <div class="navbar">
        <img src="assets/logo.png" alt="MBGWB Connect Logo" class="navbar-logo">
        <nav>
            <ul>
                <li><a href="index.php?page=dashboard">Dashboard</a></li>
                <li><a href="index.php?page=anggota" class="active">Anggota</a></li>
                <li><a href="Index.php?page=pengurus">Pengurus</a></li>
                <li><a href="index.php?page=divisi">Divisi</a></li>
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
            <h1>Daftar Anggota</h1>
            <?php if ($role_id != 2 && $role_id!=3) { ?>
                <a class="action-button primary" href="index.php?page=anggota&action=create">Tambah Anggota</a>
            <?php } ?>
            <div class="table-responsive">
                <table class="data-table" border="1" cellpadding="5" cellspacing="0"> 
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <?php if ($role_id != 2 && $role_id!=3) { ?>
                            <th>Password</th>
                        <?php } ?>
                        <th>Jenis Kelamin</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <?php if ($role_id != 2 && $role_id!=3) { ?>
                            <th>Role</th> <?php } ?>
                        <?php if ($role_id != 2 && $role_id!=3) { ?>
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
                            $jenis_kelamin_desc = '';
                            if ($row['jenis_kelamin'] == 'L') {
                                $jenis_kelamin_desc = 'Laki-laki';
                            } elseif ($row['jenis_kelamin'] == 'P') {
                                $jenis_kelamin_desc = 'Perempuan';
                            } else {
                                $jenis_kelamin_desc = $row['jenis_kelamin'];
                            }
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['username']}</td>";
                                
                                if ($role_id != 2 && $role_id!=3) {
                                    echo "<td>{$row['password']}</td>";
                                } 
                                echo "<td>{$jenis_kelamin_desc}</td>"; 
                                
                                echo "<td>{$row['no_hp']}</td>
                                <td>{$row['alamat']}</td>";
                                
                                if ($role_id != 2 && $role_id!=3){

                                    echo"<td>{$row['role_name']}</td>"; 
                                }
                                
                                if ($role_id != 2 && $role_id!=3) {
                                    echo "<td class='action-links'>
                                            <a class='action-link edit' href='index.php?page=anggota&action=edit&id={$row['id']}'>Edit</a>
                                            <a class='action-link delete' href='index.php?page=anggota&action=delete&id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                                        </td>";
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