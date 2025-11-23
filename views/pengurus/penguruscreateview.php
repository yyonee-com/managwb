<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Pengurus Baru</title>
</head>
<body>
 <div class="wrapper">
    <div class="main-content">
        <div class="container-create-edit">
            <h1>Tambah Pengurus Baru</h1>
            <?php
            if(!empty ($error_message)){
                echo "<div style='color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;'> {$error_message}</div>";
            }?>
            <form  method = "post" action="" class="data-form">
                <div class="form-group">
                <label for="anggota_id">Nama</label>
                <select name="anggota_id" id="anggota_id">
                    <option value=""> --Pilih Nama Pengurus--</option>
                    <?php
                    if(isset($anggota) &&is_object($anggota)){
                        $anggota->data_seek(0);
                        while ($row = $anggota->fetch_assoc()){
                    ?>
                        <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

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

                <label for="jabatan">Jabatan</label>
                <select name="jabatan" id="jabatan" required>
                    <option value=""> --Pilih Jabatan-- </option>
                    <option value="Ketua Divisi"> Ketua Divisi</option>
                    <option value="Sekretaris Divisi"> Sekretaris Divisi</option>
                    <option value="Bendahara Divisi"> Bendahara Divisi</option>
                    <option value="Anggota Divisi 1"> Anggota Divisi 1 </option>
                    <option value="Anggota Divisi 2"> Anggota Divisi 2 </option>
                    <option value="Anggota Divisi 3"> Anggota Divisi 3 </option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit">💾 Simpan</button>
                <a href="index.php?page=pengurus">Batal</a>
            </div>
            </form>
        </div>
    </div>
 </div>   
</body>
</html>