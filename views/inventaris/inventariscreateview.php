<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Inventaris - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>

    <div class="wrapper">
        <div class="main-content">
            <div class="container-create-edit">
                <h1>Tambah Inventaris</h1>

                <form method="post" action="" class="data-form">
                    
                    <div class="form-group">
                        <label for="nama_produk">Nama Barang</label>
                        <input type="text" id="nama_produk" name="nama_produk" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" id="jumlah" name="jumlah" required>
                    </div> 

                    <div class="form-group">
                        <label for="kondisi">Kondisi</label>
                        <select id="kondisi" name="kondisi" required>
                            <option value="Baik">Baik</option>
                            <option value="Butuh Perbaikan">Butuh Perbaikan</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="lokasi_penyimpanan">Lokasi Penyimpanan</label>
                        <input type="text" id="lokasi_penyimpanan" name="lokasi_penyimpanan" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit">💾 Simpan</button>
                        <a href="index.php?page=inventaris">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>