<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Absensi - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<body>

    <div class="wrapper">
        <div class="main-content">
            <div class="container-absen">
                <h1>Absensi <?= $data['kegiatan']['nama_kegiatan'] ?></h1>
                <form action="index.php?page=kegiatan&action=catatAbsensi" method="POST" class="data-form">
                    
                    <input type="hidden" name="kegiatan_id" value="<?= $data['kegiatan']['id'] ?>">
                    
                    <div class="absensi-form-controls">
                        <div class="form-group">
                            <label for="tanggal_absensi">Tanggal Absensi</label>
                            <input type="date" id="tanggal_absensi" name="tanggal_absensi" value="<?= $data['tanggal_absensi'] ?>" required>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table class="data-table" border="1" cellpadding="5" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th style="width: 20%;">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['anggota_absensi'])): ?>
                                <?php foreach ($data['anggota_absensi'] as $anggota): ?>
                                <tr>
                                    <!-- <td><?= $kegiatan['kegiatan'] ?></td> -->
                                    <td><?= $anggota['nama'] ?></td>
                                    <td>
                                        <input type="hidden" name="absensi[<?= $anggota['anggota_id'] ?>][anggota_id]" value="<?= $anggota['anggota_id'] ?>">
                                        
                                        <select name="absensi[<?= $anggota['anggota_id'] ?>][status_kehadiran]" id="status_<?= $anggota['anggota_id'] ?>">
                                            <option value="hadir" <?= $anggota['status_kehadiran'] == 'hadir' ? 'selected' : '' ?>>Hadir</option>
                                            <option value="tidak_hadir" <?= $anggota['status_kehadiran'] == 'tidak_hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;">Tidak ada anggota yang terdaftar untuk kegiatan ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="form-actions mt-3">
                        <button type="submit">💾 Simpan Absensi</button>
                        <a href="index.php?page=kegiatan&action=list">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>