<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-content">
        <div class="container-create-edit">
            <h1>Edit Data Anggota</h1>

            <form method="post" action="" class="data-form">
                
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?= $anggota['nama']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?= $anggota['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" value="<?= $anggota['password']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" <?= $anggota['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="P" <?= $anggota['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="<?= $anggota['no_hp']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" required><?= $anggota['alamat']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select id="role_id" name="role_id" required>
                        <option value="">-- Pilih --</option>
                        <option value="1" <?= $anggota['role_id'] == '1' ? 'selected' : ''; ?>>Admin</option>
                        <option value="2" <?= $anggota['role_id'] == '2' ? 'selected' : ''; ?>>Penanggung Jawab</option>
                        <option value="3" <?= $anggota['role_id'] == '3' ? 'selected' : ''; ?>>Anggota</option>
                    </select>
                </div>
                
                <div class="form-actions">
                    <button type="submit">💾 Simpan Perubahan</button>
                    <a href="index.php?page=anggota">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>