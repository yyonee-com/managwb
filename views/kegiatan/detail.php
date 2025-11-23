<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="wrapper">
        <div class="main-content">
            <div class="container">
                <h1>Detail Presensi</h1> 
                
                <h2><?= $data['kegiatan']['nama_kegiatan'] ?></h2>
                <hr>

                <h3>Pencatatan & Rekap Absensi</h3>
                <?php if (!empty($data['rekap_tanggal'])): ?>
                    <?php if (!empty($data['detail_absensi'])): ?>
                        <h4>Rekap Kehadiran Tanggal <?= date('d F Y', strtotime($data['tanggal_terpilih'])) ?></h4>
                        <table border="1" cellpadding="5" cellspacing ="0"class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['detail_absensi'] as $absen): ?>
                                <tr>
                                    <td><?= $absen['nama'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= ($absen['status_kehadiran'] == 'hadir' ? 'success' : ($absen['status_kehadiran'] == 'tidak_hadir' ? 'danger' : 'secondary')) ?>">
                                            <?= ucfirst(str_replace('_', ' ', $absen['status_kehadiran'])) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="alert alert-info">Belum ada absensi yang dicatat untuk kegiatan ini.</p>
                <?php endif; ?>
                
                <div class="form-actions mt-3">
                    <a href="index.php?page=kegiatan&action=list">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>