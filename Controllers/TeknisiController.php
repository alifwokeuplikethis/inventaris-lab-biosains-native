<?php
namespace Controllers;

use Models\BahanModel;
use Models\Database;
use Exception;

class TeknisiController{

    private BahanModel $model;
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
        $this->model = new BahanModel($this->conn);
    }

    /* ================= DASHBOARD ================= */
    public function dashboard() {
        $stats = $this->model->getDashboardStats();
        $data = $this->model->getDashboardBahan();
        require PAGES_PATH . 'teknisi/dashboard.php';
    }

}
?>