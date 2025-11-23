<?php
class PengurusController {
    private $model;

    public function __construct($PengurusModel){
        $this->model = $PengurusModel;
    }

    public function index(){
        $role_id = $_SESSION['user']['role_id'];
        $result = $this->model->getAllPengurus();
        include 'views/pengurus/penguruslistview.php';
    }

    public function create (){
        $error_message='';
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $anggota_id = $_POST['anggota_id'];
            $divisi_id = $_POST ['divisi_id'];
            $jabatan = $_POST['jabatan'];

            $result = $this->model->createPengurus ($anggota_id, $divisi_id, $jabatan);
            if ($result === true) {
            header("Location: index.php?page=pengurus&action=list"); 
            exit;
        } elseif (is_string($result) && strpos($result, 'Error:') === 0) {
            $error_message = substr($result, 7);
        } else {
            $error_message = "Gagal menyimpan data pengurus. Silakan coba lagi.";
        }
        }
        $divisi = $this->model->getAllDivisi();
        $anggota = $this->model->getAllAnggota();
        include 'views/pengurus/penguruscreateview.php';
    }

    public function edit($id){
        $error_message='';
        $pengurus = $this->model->getPengurusById($id);
        $divisi_list = $this->model->getAllDivisi();
        $anggota_list = $this->model->getAllAnggota();
        if (!$pengurus){
            echo "<script>alert ('Data pengurus tidak ditemukan'); window.location='index.php?page=pengurus&action=list';</script>";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $anggota_id = $_POST['anggota_id'];
            $divisi_id = $_POST ['divisi_id'];
            $jabatan = $_POST['jabatan'];
            
            $result = $this->model->updatePengurus($id, $anggota_id, $divisi_id, $jabatan);
            
            if ($result === true) {
                // SUCCESS: Redirect ke halaman daftar
                header("Location: index.php?page=pengurus&action=list");
                exit;
            } elseif (is_string($result) && strpos($result, 'Error:') === 0) {
                // VALIDATION ERROR: Tampilkan pesan error dan timpa data di form dengan input user
                $error_message = substr($result, 7);
                $pengurus['anggota_id'] = $anggota_id;
                $pengurus['divisi_id'] = $divisi_id;
                $pengurus['jabatan'] = $jabatan;
            } else {
                // DB ERROR/UNDEFINED ERROR: Jika model mengembalikan FALSE
                $error_message = "Terjadi kegagalan yang tidak terduga saat memperbarui data.";
                $pengurus['anggota_id'] = $anggota_id;
                $pengurus['divisi_id'] = $divisi_id;
                $pengurus['jabatan'] = $jabatan;
            }
        }
        include 'views/pengurus/penguruseditview.php';
    }

    public function delete ($id){
        $this->model->deletePengurus($id);
        header("Location: index.php?page=pengurus&action=list");
        exit;
    }
}