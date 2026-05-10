<?php
namespace Controllers;

use Models\BahanModel;
use Models\Database;

class KadaluarsaController{
    private $model;

    public function __construct(){
        $conn = (new Database())->getConnection();
        $this->model = new BahanModel($conn);
    }


    public function getKadaluarsa(){
        $dataKadaluarsa = $this->model->getStatusKadaluarsa();
        $totalHampir = count(array_filter(
        $dataKadaluarsa,
        fn($item) => $item['status_kadaluarsa'] === 'hampir kadaluarsa'
        ));

        $totalExpired = count(array_filter(
        $dataKadaluarsa,
        fn($item) => $item['status_kadaluarsa'] === 'expired'
        ));
        require PAGES_PATH . 'kadaluarsa.php';
    }
}
?>