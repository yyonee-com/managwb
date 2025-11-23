<?php
class AnggotaController {
    private $model;

    public function __construct($AnggotaModel) {
        $this->model = $AnggotaModel;
    }

    public function index() {
        $role_id =$_SESSION['user']['role_id'];
        $result = $this->model->getAllAnggota();
        include 'views/anggota/anggotalistview.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jk = $_POST['jenis_kelamin'];
            $no_hp = $_POST['no_hp'];
            $alamat = $_POST['alamat'] ?? '-'; 
            $role_id = $_POST['role_id']; 

            $this->model->createAnggota($nama, $username, $password, $jk, $no_hp, $alamat, $role_id);
            header("Location: index.php?page=anggota&action=list");
            exit;
        }
        include 'views/anggota/anggotacreateview.php';
    }

    public function edit($id) {
        $anggota = $this->model->getAnggotaById($id); 
        if (!$anggota){ 
            echo "<script>alert('Data anggota tidak ditemukan.'); window.location='index.php?page=anggota&action=list';</script>";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $username= $_POST['username'];
            $password = $_POST['password']; 
            $jk = $_POST['jenis_kelamin'];
            $no_hp = $_POST['no_hp'];
            $alamat = $_POST['alamat'] ?? '-'; 
            $role_id = $_POST['role_id'];

            $this->model->updateAnggota($id, $nama, $username, $password, $jk, $no_hp, $alamat, $role_id);
            header("Location: index.php?page=anggota&action=list");
            exit;
        }
        include 'views/anggota/anggotaeditview.php';
    }

    public function delete($id) {
        $this->model->deleteAnggota($id);
        header("Location: index.php?page=anggota&action=list");
        exit;
    }
}
?>
