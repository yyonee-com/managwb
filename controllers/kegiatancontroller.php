<?php
class KegiatanController{
    private $kegiatanModel;
    private $absensiModel;
    private $keuanganModel; // 1. Tambahkan properti untuk KeuanganModel

    // 2. Perbarui Constructor
    public function __construct($KegiatanModel, $AbsensiModel, $KeuanganModel){
        $this->kegiatanModel = $KegiatanModel;
        $this->absensiModel = $AbsensiModel;
        $this->keuanganModel = $KeuanganModel; // Inisialisasi KeuanganModel
    }
    
    // ... (Metode view, detail, formAbsensi, catatAbsensi, index, create, edit, delete tetap sama) ...
    public function view ($view_name, $data =[]){
        extract($data);
        require_once 'views/' .$view_name.'.php';
    }
    public function detail($kegiatan_id) {
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanById($kegiatan_id);
        $data['rekap_tanggal'] = $this->absensiModel->getRekapAbsensiByKegiatan($kegiatan_id);
        $tanggal_terpilih = $_GET['tanggal'] ?? (count($data['rekap_tanggal']) > 0 ? $data['rekap_tanggal'][0]['tanggal_absensi'] : null);
        
        if ($tanggal_terpilih) {
            $data['tanggal_terpilih'] = $tanggal_terpilih;
            $data['detail_absensi'] = $this->absensiModel->getAbsensiDetailByDate($kegiatan_id, $tanggal_terpilih);
        } else {
            $data['detail_absensi'] = [];
            $data['tanggal_terpilih']=null;
        }

        $this->view('kegiatan/detail', $data);
    }

    public function formAbsensi($kegiatan_id) {
        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanById($kegiatan_id);
        $data['anggota_absensi'] = $this->absensiModel->getAbsensiDetailByDate($kegiatan_id, $tanggal);
        $data['tanggal_absensi'] = $tanggal;
        $this->view('kegiatan/formabsensi', $data);
    }

    public function catatAbsensi() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kegiatan_id = $_POST['kegiatan_id'];
            $tanggal_absensi = $_POST['tanggal_absensi'];
            $data_absensi = $_POST['absensi']; 
            $this->absensiModel->catatAbsensi($kegiatan_id, $tanggal_absensi, $data_absensi);
            header("Location: index.php?page=kegiatan&action=detail&id={$kegiatan_id}&tanggal={$tanggal_absensi}");
            exit;
        }
    }

    public function index (){
        $role_id =$_SESSION['user']['role_id'];
        $result = $this->kegiatanModel->getAllKegiatan();
        include 'views/kegiatan/kegiatanlistview.php';
    }

    public function create (){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $divisi_id = $_POST['divisi_id'];
            $nama_kegiatan = $_POST['nama_kegiatan'];
            $penanggung_jawab_id = $_POST['penanggung_jawab_id'];
            $tempat = $_POST['tempat'];
            $status_kegiatan = $_POST['status_kegiatan'];

            $this->kegiatanModel->createKegiatan($divisi_id, $nama_kegiatan, $penanggung_jawab_id, $tempat, $status_kegiatan);
            header("Location: index.php?page=kegiatan&action=list");
            exit;
        }

        $divisi = $this->kegiatanModel->getAllDivisi();
        $anggota = $this->kegiatanModel->getAllAnggota();
        include 'views/kegiatan/kegiatancreateview.php';
    }

    public function edit ($id){
        $kegiatan = $this->kegiatanModel->getKegiatanById($id);
        $divisi_list =$this->kegiatanModel->getAllDivisi();
        $penanggung_jawab_list=$this->kegiatanModel->getAllAnggota();
        if (!$kegiatan){
            echo "<script>alert ('Data kegiatan tidak ditemukan'); window.location='index.php?page=kegiatan&action=list';</script>";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $divisi_id = $_POST['divisi_id'];
            $nama_kegiatan = $_POST['nama_kegiatan'];
            $penanggung_jawab_id = $_POST['penanggung_jawab_id'];
            $tempat = $_POST['tempat'];
            $status_kegiatan = $_POST['status_kegiatan'];

            $this->kegiatanModel->updateKegiatan($id, $divisi_id, $nama_kegiatan, $penanggung_jawab_id, $tempat, $status_kegiatan);
            header("Location: index.php?page=kegiatan&action=list");
            exit;
        }
        include 'views/kegiatan/kegiataneditview.php';
    }
        
    public function delete ($id){
        $this->kegiatanModel->deleteKegiatan($id);
        header("Location: index.php?page=kegiatan&action=list");
        exit;
    }

    // ====================================================================
    // 3. FUNGSI BARU UNTUK KEUANGAN
    // ====================================================================

    /**
     * Menampilkan daftar keuangan keuangan untuk kegiatan tertentu.
     */
    public function listKeuangan($kegiatan_id) {
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanById($kegiatan_id);
        $data['keuangan_keuangan'] = $this->keuanganModel->getAllkeuanganByKegiatan($kegiatan_id);
        
        $this->view('kegiatan/kegiatanlistkeuanganview', $data);
    }

    public function formKeuangan($kegiatan_id) {
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanById($kegiatan_id);
        $keuangan_id = $_GET['keuangan_id'] ?? null;
        $keuangan = null;

        if ($keuangan_id) {
            $keuangan = $this->keuanganModel->getkeuanganById($keuangan_id);
            if (!$keuangan || $keuangan['kegiatan_id'] != $kegiatan_id) {
            }
        }
        $this->view('kegiatan/kegiatanformkeuanganview', array_merge($data, ['keuangan' => $keuangan]));
    }
    
    public function saveKeuangan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kegiatan_id = $_POST['kegiatan_id'];
            $keuangan_id = $_POST['keuangan_id'] ?? null;
            $tanggal = $_POST['tanggal'];
            $jenis_transaksi = $_POST['jenis_transaksi'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan']; // Variabel ini berisi deskripsi dari form
            
            if (empty($tanggal) || !strtotime($tanggal)) {
            echo "<script>alert('Tanggal Transaksi wajib diisi dan harus dalam format yang valid.'); window.history.back();</script>";
            exit;
            }
            
            if ($keuangan_id) {
                // PERBAIKAN 1A: Pemanggilan updatekeuangan
                // Model expects: ($transaksi_id, $kegiatan_id, $tanggal, $jenis_transaksi, $jumlah, $deskripsi)
                $this->keuanganModel->updatekeuangan(
                    $keuangan_id, $kegiatan_id, $tanggal, $jenis_transaksi, $jumlah, $keterangan
                );
            } else {
                // PERBAIKAN 1B: Pemanggilan createkeuangan
                // Model expects: ($kegiatan_id, $jenis_transaksi, $deskripsi, $jumlah, $tanggal_transaksi)
                $this->keuanganModel->createkeuangan(
                    $kegiatan_id, $jenis_transaksi, $keterangan, $jumlah, $tanggal
                );
            }
            header("Location: index.php?page=kegiatan&action=listKeuangan&id={$kegiatan_id}");
            exit;
        }
    }

    public function deleteKeuangan($keuangan_id) {
        $kegiatan_id = $_GET['id'] ?? null;
        if ($keuangan_id) {
            $this->keuanganModel->deletekeuangan($keuangan_id);
        }
        if ($kegiatan_id) {
            header("Location: index.php?page=kegiatan&action=listKeuangan&id={$kegiatan_id}");
        } else {
            header("Location: index.php?page=kegiatan&action=list");
        }
        exit;
    }
}