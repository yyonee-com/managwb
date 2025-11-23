<?php
session_start();

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        require_once __DIR__ . '/controllers/AuthController.php';
        $authController = new AuthController();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;
    
    case 'dashboard':
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit();
        }
        require_once __DIR__ . '/views/dashboard.php';
        break;
    case 'anggota':
        require_once __DIR__ .'/controllers/anggotacontroller.php';
        require_once __DIR__ .'/models/anggotamodel.php';
        require_once __DIR__ .'/config/database.php';

        $database = new Database();
        $db = $database->getConnection();
        $model = new AnggotaModel($db);
        $controller = new AnggotaController($model); 
        $role_id =$_SESSION['user']['role_id'];
        $action = $_GET['action'] ?? 'list';

        if ($role_id == 2 && $role_id == 3) { 
            if ($action != 'list' && $action != 'index') {
                echo "<script>alert('Akses Ditolak. Penanggung Jawab hanya dapat melihat data.'); window.location='index.php?page=anggota&action=list';</script>";
                exit;
            }
        }
        if ($action == 'list') {
            $controller->index();
        } elseif ($action == 'create') {
            $controller->create();
        } elseif ($action == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'pengurus':
        require_once __DIR__ .'/controllers/penguruscontroller.php';
        require_once __DIR__ .'/models/pengurusmodel.php';
        require_once __DIR__ .'/config/database.php';
        
        $database = new Database ();
        $db = $database->getConnection();
        $model = new PengurusModel($db);
        $controller = new PengurusController($model);
        $role_id = $_SESSION['user']['role_id'];
        $action = $_GET['action']??'list';

        if ($role_id ==! 2 && $role_id ==! 3 ) { 
            if ($action != 'list' && $action != 'index') {
                echo "<script>alert('Akses Ditolak. Penanggung Jawab hanya dapat melihat data.'); window.location='index.php?page=anggota&action=list';</script>";
                exit;
            }
        }
        if ($action == 'list') {
            $controller->index();
        } elseif ($action == 'create') {
            $controller->create();
        } elseif ($action == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;       
    case 'divisi':
        require_once __DIR__ .'/controllers/divisicontroller.php';
        require_once __DIR__ .'/models/divisimodel.php';
        require_once __DIR__ .'/config/database.php';

        $database = new Database();
        $db = $database->getConnection();
        $model = new DivisiModel($db);
        $controller = new DivisiController($model); 
        $role_id = $_SESSION['user']['role_id'];
        $action = $_GET['action'] ?? 'list';
        
        if ($action == 'list') {
            $controller->index();
        } elseif ($action == 'create') {
            $controller->create();
        } elseif ($action == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;  
    case 'kegiatan':
        require_once __DIR__ .'/controllers/kegiatancontroller.php';
        require_once __DIR__ .'/models/kegiatanmodel.php';
        require_once __DIR__ .'/models/absensimodel.php';
        require_once __DIR__ .'/config/database.php';
        require_once __DIR__ .'/models/keuanganmodel.php';
        
        $database = new Database();
        $db = $database->getConnection();
        $kegiatanModel = new KegiatanModel($db);
        $absensiModel = new AbsensiModel($db);
        $keuanganModel = new KeuanganModel($db);
        $controller = new KegiatanController ($kegiatanModel, $absensiModel, $keuanganModel);
        $role_id = $_SESSION['user']['role_id'];
        $action = $_GET['action']?? 'list';

        if ($action == 'list') {
            $controller->index();
        } elseif ($action == 'create') {
            $controller->create();
        } elseif ($action =='detail'&& isset ($_GET['id'])){
            $controller->detail($_GET['id']);
        } elseif($action =='formAbsensi'&& isset($_GET['id'])){
            $controller->formAbsensi($_GET['id']);
        } elseif ($action =='catatAbsensi'){
            $controller->catatAbsensi();
        } elseif ($action == 'listKeuangan' && isset($_GET['id'])) {
            $controller->listKeuangan($_GET['id']);
        } elseif ($action == 'formKeuangan' && isset($_GET['id'])) {
            $controller->formKeuangan($_GET['id']);
        } elseif ($action == 'saveKeuangan') {
            $controller->saveKeuangan();
        } elseif ($action == 'deleteKeuangan' && isset($_GET['id'])) {
            $controller->deleteKeuangan($_GET['keuangan_id'] ?? null); 
        }elseif ($action == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break; 
        
    case 'inventaris':
        require_once __DIR__ .'/controllers/inventariscontroller.php';
        require_once __DIR__ .'/models/inventarismodel.php';
        require_once __DIR__ .'/config/database.php';

        $database = new Database();
        $db = $database->getConnection();
        $model = new InventarisModel($db);
        $controller = new InventarisController ($model);
        $role_id = $_SESSION['user']['role_id'];
        $action =$_GET['action']??'list';

        if ($action == 'list') {
            $controller->index();
        } elseif ($action == 'create') {
            $controller->create();
        } elseif ($action == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;  
    case 'absensi':
        require_once __DIR__ .'/controllers/absensicontroller.php';
        require_once __DIR__ .'/models/absensimodel.php';
        require_once __DIR__ .'/config/database.php';

        $database = new Database();
        $db = $database->getConnection();
        $model = new KegiatanModel($db);
        $controller = new KegiatanController ($model);
        $role_id =$_SESSION['user']['role_id'];
        $action = $_GET['action']??'list';

        if ($action == 'list') {
            $controller->index();
        } elseif ($action == 'create') {
            $controller->create();
        } elseif ($action == 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action == 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;         
    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        break;

    default:
        require_once __DIR__ . '/controllers/logincontroller.php';
        loginController::index();
        break;
}