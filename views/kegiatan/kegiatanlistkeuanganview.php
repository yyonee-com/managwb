<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Kegiatan - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="wrapper">
        <div class="main-content">
            <div class="container">
                <h1>Keuangan Kegiatan: <?= $data['kegiatan']['nama_kegiatan'] ?></h1>
                
                <a class="action-button primary" href="index.php?page=kegiatan&action=formKeuangan&id=<?= $data['kegiatan']['id'] ?>">
                    ➕ Masukkan Transaksi
                </a>
                
                <?php 
                    // INISIALISASI VARIABEL TOTAL (DIPERTAHANKAN)
                    $total_pemasukan = 0; 
                    $total_pengeluaran = 0;
                ?>

                <div class="table-responsive mt-3">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['keuangan_keuangan'])): ?>
                                <?php 
                                foreach ($data['keuangan_keuangan'] as $keuangan): 
                                    
                                    // 2. Tentukan format tanggal
                                    $raw_date = $keuangan['tanggal_transaksi'];
                                    $timestamp = strtotime($raw_date);
                                    $jenis_transaksi_hitung = strtolower($keuangan['jenis_transaksi']);
                                    
                                    if ($jenis_transaksi_hitung == 'pemasukan') {
                                        $total_pemasukan += (float)$keuangan['jumlah'];
                                    } else {
                                        $total_pengeluaran += (float)$keuangan['jumlah'];
                                    }
                                    // Cek apakah strtotime berhasil dan tanggalnya tidak '0000-00-00'
                                    if ($timestamp !== false && $timestamp > 0) {
                                        $formatted_date = date('d F Y', $timestamp);
                                    } else {
                                        $formatted_date = 'Tanggal Tidak Valid'; // Tampilkan pesan jika tanggal bermasalah
                                    }
                                ?>
                                <tr>
                                    <td><?= $formatted_date ?></td>
                                    
                                    <td><?= ucfirst($keuangan['jenis_transaksi']) ?></td>
                                    <td><?= $keuangan['deskripsi'] ?></td>
                                    <td style="text-align:center;">Rp. <?= number_format($keuangan['jumlah'], 0, ',', '.') ?></td>
                                    <td class='action-links'>
                                        <a class='action-link delete' href='index.php?page=kegiatan&action=deleteKeuangan&keuangan_id=<?= $keuangan['id'] ?>&id=<?= $data['kegiatan']['id'] ?>' onclick="return confirm('Yakin ingin menghapus keuangan ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">Belum ada keuangan keuangan yang dicatat.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align: center;">Total Pemasukan</th>
                                <th style="text-align: center; color: green;">Rp. <?= number_format($total_pemasukan, 0, ',', '.') ?></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: center;">Total Pengeluaran</th>
                                <th style="text-align: center; color: red;">Rp. <?= number_format($total_pengeluaran, 0, ',', '.') ?></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: center;">Saldo Akhir</th>
                                <th style="text-align: center; font-weight: bold;">Rp. <?= number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="form-actions mt-3">
                    <a href="index.php?page=kegiatan&action=list">Kembali ke Daftar Kegiatan</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>