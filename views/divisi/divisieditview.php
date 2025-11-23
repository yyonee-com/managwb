<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Divisi - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
    
    <div class="navbar">
        </div>
    <div class="main-content">
        <div class="container-create-edit">
            <h1>Edit Divisi</h1>

            <form method="post" action="" class="data-form">
                
                <div class="form-group">
                    <label for="nama_divisi">Nama Divisi</label>
                    <input type="text" id="nama_divisi" name="nama_divisi" value="<?= $divisi['nama_divisi']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required><?= $divisi['deskripsi']; ?></textarea>
                </div>
                

                <div class="form-actions">
                    <button type="submit">💾 Simpan Perubahan</button>
                    <a href="index.php?page=divisi">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>