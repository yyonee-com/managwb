<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengurus - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <div class="main-content">
        <div class="container-create-edit">
            <h1>Edit Data Anggota</h1>
            <?php
            if (!empty($error_message)) {
            echo "<div style='color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;'> {$error_message}</div>";
            }
            ?>
            <form  method="post" action="" class="data-form">
                <div class="form-group">
                    <label for="anggota_id">Nama</label>
                    <select id="anggota_id" name="anggota_id" required>
                    <option value="">-- Pilih Nama Pengurus --</option>
                    <?php 
                    $data_anggota = isset($anggota_list) ? $anggota_list : (isset($anggota) ? $anggota : null);
                
                    if ($data_anggota && $data_anggota->num_rows > 0) {
                        $data_anggota->data_seek(0);
                        while ($row = $data_anggota->fetch_assoc()) { 
                    ?>
                        <option value="<?= $row['id']; ?>" <?= $pengurus['anggota_id'] == $row['id'] ? 'selected' : ''; ?>>
                            <?= $row['nama']; ?>
                        </option>
                    <?php
                    }
                    }
                    ?>
                    </select>
                    
                    <label for="divisi_id">Divisi</label>
                    <select id="divisi_id" name="divisi_id" required>
                        <option value="">-- Pilih Divisi --</option>
                        <?php 
                        $data_divisi = isset($divisi_list) ? $divisi_list : (isset($divisi) ? $divisi : null);
                    
                        if ($data_divisi && $data_divisi->num_rows > 0) {
                            $data_divisi->data_seek(0);
                            while ($row = $data_divisi->fetch_assoc()) { 
                        ?>
                            <option value="<?= $row['id']; ?>" <?= $pengurus['divisi_id'] == $row['id'] ? 'selected' : ''; ?>>
                                <?= $row['nama_divisi']; ?>
                            </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    
                    <label for="jabatan">Jabatan</label>
                    <select id="jabatan" name="jabatan" required>
                        <option value="">--Pilih Jabatan-</option>
                        <option value="Ketua Divisi" <?= $pengurus['jabatan'] == 'Ketua Divisi' ? 'selected' : ''; ?>>Ketua Divisi</option>
                        <option value="Sekretaris Divisi" <?= $pengurus['jabatan'] == 'Sekretaris Divisi' ? 'selected' : ''; ?>>Sekretaris Divisi</option>
                        <option value="Bendahara Divisi" <?= $pengurus['jabatan'] == 'Bendahara Divisi' ? 'selected' : ''; ?>>Bendahara Divisi</option>
                        <option value="Anggota Divisi 1" <?= $pengurus['jabatan'] == 'Anggota Divisi 1' ? 'selected' : ''; ?>>Anggota Divisi 1</option>
                        <option value="Anggota Divisi 2" <?= $pengurus['jabatan'] == 'Anggota Divisi 2' ? 'selected' : ''; ?>>Anggota Divisi 2</option>
                        <option value="Anggota Divisi 3" <?= $pengurus['jabatan'] == 'Anggota Divisi 3' ? 'selected' : ''; ?>>Anggota Divisi 3</option>
                    </select>                   
                </div>
                <div class="form-actions">
                        <button type="submit">💾 Simpan Perubahan</button>
                        <a href="index.php?page=pengurus">Batal</a>
                    </div>
            </form>
        </div>
    </div>
</div>    
</body>
</html>