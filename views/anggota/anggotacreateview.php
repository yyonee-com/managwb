<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main-content">
    <div class="container-create-edit">
        <h1>Tambah Anggota</h1>
        <form method="post" action="" class="data-form">
            
            <div class="form-fields-wrapper"> 
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" required></textarea>
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select id="role_id" name="role_id" required>
                        <option value="">-- Pilih --</option>
                        <option value="1">Admin</option>
                        <option value="2">Penanggung Jawab</option>
                        <option value="3">Anggota</option>
                    </select>
                </div>
                
            </div> 

            <div class="form-actions">
                <button type="submit">💾 Simpan</button>
                <a href="index.php?page=anggota">Batal</a>
            </div>
            
        </form>
    </div>
</div>

</body>
</html>