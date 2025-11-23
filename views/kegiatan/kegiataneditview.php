<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>

    <div class="wrapper">
        <div class="main-content">
            <div class="container-create-edit">
                <h1>Edit Kegiatan</h1>

                <form method="post" action="" class="data-form">

                    <div class="form-group">
                        <label for="divisi_id">Divisi:</label>
                        <select id="divisi_id" name="divisi_id" required>
                            <option value="">-- Pilih Divisi --</option>
                            <?php 
                            $data_divisi = isset($divisi_list) ? $divisi_list : (isset($divisi) ? $divisi : null);
                        
                            if ($data_divisi && $data_divisi->num_rows > 0) {
                                $data_divisi->data_seek(0);
                                while ($row = $data_divisi->fetch_assoc()) { 
                            ?>
                                <option value="<?= $row['id']; ?>" <?= $kegiatan['divisi_id'] == $row['id'] ? 'selected' : ''; ?>>
                                    <?= $row['nama_divisi']; ?>
                                </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan:</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="<?= $kegiatan['nama_kegiatan']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="penanggung_jawab_id">Penanggung Jawab:</label>
                        <select id="penanggung_jawab_id" name="penanggung_jawab_id" required>
                        <option value="">-- Pilih Penanggung Jawab --</option>
                        <?php 
                        $data_pj = isset($penanggung_jawab_list) ? $penanggung_jawab_list : null;
                        
                        if ($data_pj && $data_pj->num_rows > 0) {
                            if (method_exists($data_pj, 'data_seek')) {
                                $data_pj->data_seek(0);
                            }
                            
                            while ($row = $data_pj->fetch_assoc()) { 
                        ?>
                            <option value="<?= $row['id']; ?>" 
                                    <?= (isset($kegiatan) && $kegiatan['penanggung_jawab_id'] == $row['id']) ? 'selected' : ''; ?>>
                                <?= $row['nama']; ?> 
                            </option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tempat">Tempat:</label>
                        <textarea id="tempat" name="tempat" required><?= $kegiatan['tempat']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status_kegiatan">Status:</label>
                        <select id="status_kegiatan" name="status_kegiatan" required>
                            <option value="">--Pilih Status--</option>
                            <option value="Rencana" <?= $kegiatan['status_kegiatan'] == 'Rencana' ? 'selected' : ''; ?>>Rencana</option>
                            <option value="Berjalan" <?= $kegiatan['status_kegiatan'] == 'Berjalan' ? 'selected' : ''; ?>>Berjalan</option>
                            <option value="Terlaksana" <?= $kegiatan['status_kegiatan'] == 'Terlaksana' ? 'selected' : ''; ?>>Terlaksana</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit">💾 Simpan Perubahan</button>
                        <a href="index.php?page=kegiatan">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>