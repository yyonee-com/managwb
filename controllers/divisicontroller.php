<?php
class DivisiController{
    private $model;

    public function __construct($DivisiModel){
        $this->model=$DivisiModel;
    }

    public function index(){
        $role_id = $_SESSION ['user']['role_id'];
        $result =$this->model->getAllDivisi();
        include 'views/divisi/divisilistview.php';
    }

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nama_divisi = $_POST['nama_divisi'];
            $deskripsi = $_POST['deskripsi'];

            $result = $this->model->createDivisi($nama_divisi, $deskripsi);
            header("Location:index.php?page=divisi&action=list");
            exit;
        }
        include 'views/divisi/divisicreateview.php';
    }

    public function edit ($id){
        $divisi = $this->model->getDivisiById($id); 
        if (!$divisi) {
            echo "<script>alert('Data divisi tidak ditemukan.'); window.location='index.php?page=divisi&action=list';</script>";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nama_divisi = $_POST['nama_divisi'];
            $deskripsi = $_POST['deskripsi'];
            
            $this->model->updateDivisi($id, $nama_divisi, $deskripsi,);
            header("Location: index.php?page=divisi&action=list");
            exit;
        }

        include 'views/divisi/divisieditview.php';
    }

    public function delete ($id){
        $this->model->deleteDivisi($id);
        header("Location: index.php?page=divisi&action=list");
        exit;
    }
}
?>