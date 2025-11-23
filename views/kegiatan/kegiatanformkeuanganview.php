<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Transaksi - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="wrapper">
        <div class="main-content">
            <div class="container-create-edit">
                <h1><?= isset($keuangan) ? 'Edit Transaksi' : 'Catar Transaksi Baru' ?></h1>
                <h2>Kegiatan: <?= $data['kegiatan']['nama_kegiatan'] ?></h2>
                
                <form action="index.php?page=kegiatan&action=saveKeuangan" method="POST" class="data-form">
                    
                    <input type="hidden" name="kegiatan_id" value="<?= $data['kegiatan']['id'] ?>">
                    <?php if (isset($keuangan)): ?>
                        <input type="hidden" name="keuangan_id" value="<?= $keuangan['id'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Transaksi:</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?= isset($keuangan) ? $keuangan['tanggal'] : date('Y-m-d') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_transaksi">Jenis Transaksi:</label>
                        <select id="jenis_transaksi" name="jenis_transaksi" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Pemasukan" <?= (isset($keuangan) && $keuangan['jenis_transaksi'] == 'pemasukan') ? 'selected' : '' ?>>Pemasukan</option>
                            <option value="Pengeluaran" <?= (isset($keuangan) && $keuangan['jenis_transaksi'] == 'pengeluaran') ? 'selected' : '' ?>>Pengeluaran</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="jumlah">Jumlah (Rp):</label>
                        <input type="number" id="jumlah" name="jumlah" value="<?= isset($keuangan) ? $keuangan['jumlah'] : '' ?>" required min="0">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea id="keterangan" name="keterangan" required><?= isset($keuangan) ? $keuangan['keterangan'] : '' ?></textarea>
                    </div>

                    <div class="form-actions mt-3">
                        <button type="submit">💾 Simpan Transaksi</button>
                        <a href="index.php?page=kegiatan&action=listKeuangan&id=<?= $data['kegiatan']['id'] ?>">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>