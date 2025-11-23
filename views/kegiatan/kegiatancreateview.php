<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan Baru - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
    <div class="wrapper">
        <div class="main-content">
            <div class="container-create-edit"> 
                <h1>Tambah Kegiatan Baru</h1>

                <form method="post" action="" class="data-form">
                    
                    <div class="form-group">
                        <label for="divisi_id">Divisi</label>
                        <select id="divisi_id" name="divisi_id" required>
                            <option value="">-- Pilih Divisi --</option>
                            <?php 
                            if (isset($divisi) && is_object($divisi)) {
                                $divisi->data_seek(0);
                                while ($row = $divisi->fetch_assoc()) { 
                            ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama_divisi']; ?></option>
                            <?php 
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" required>
                    </div>

                    <div class="form-group">
                        <label for="penanggung_jawab_id">Penanggung Jawab</label>
                        <select id="penanggung_jawab_id" name="penanggung_jawab_id" required>
                            <option value="">-- Pilih Penanggung Jawab --</option>
                            <?php 
                            if (isset($pengurus) && is_object($pengurus)) {
                                $pengurus->data_seek(0);
                                while ($row = $pengurus->fetch_assoc()) { 
                            ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                            <?php 
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tempat">Tempat:</label>
                        <textarea id="tempat" name="tempat" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status_kegiatan">Status Kegiatan:</label>
                        <select id="status_kegiatan" name="status_kegiatan" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Rencana">Rencana</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit">💾 Simpan</button>
                        <a href="index.php?page=kegiatan">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>