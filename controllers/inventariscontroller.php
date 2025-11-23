<?php
class InventarisController {
    private $model;
    private $role_id;

    public function __construct ($InventarisModel){
        $this->model =$InventarisModel;
    }
    public function index(){
        $role_id =$_SESSION['user']['role_id'];
        $result = $this->model->getAllInventaris();
        include 'views/inventaris/inventarislistview.php'; 
    }
    public function create (){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $nama_produk = $_POST['nama_produk'];
            $jumlah = $_POST['jumlah'];
            $kondisi = $_POST['kondisi'];
            $lokasi_penyimpanan = $_POST['lokasi_penyimpanan'];

            $this->model->createInventaris ($nama_produk, $jumlah, $kondisi, $lokasi_penyimpanan);
            header("Location: index.php?page=inventaris&action=list");
            exit;
        }
        include 'views/inventaris/inventariscreateview.php';
    }

    public function edit($id){
        $inventaris =$this->model->getInventarisById($id);
        if (!$inventaris){
            echo "<script>alert(' tidak ditemukan,');window.location=index.php?page=inventaris&action=list';</script>";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD']=='POST'){
             $nama_produk = $_POST['nama_produk'];
            $jumlah = $_POST['jumlah'];
            $kondisi = $_POST['kondisi'];
            $lokasi_penyimpanan = $_POST['lokasi_penyimpanan']; 

            $this->model->updateInventaris($id, $nama_produk, $jumlah, $kondisi, $lokasi_penyimpanan);
            header("Location: index.php?page=inventaris&action=list ");
            exit();
        }
        include 'views/inventaris/inventariseditview.php';
    }

    public function delete ($id){
        $this->model->deleteInventaris($id);
        header("Location: index.php?page=inventaris&action=list");
        exit;
    }
}
?>