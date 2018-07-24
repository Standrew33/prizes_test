<?php
require_once "../Models/Prize.php";

$objPrize = new PrizeController();

if(isset($_GET['GetPrize'])) {
    return $objPrize->GetPrize();
}

class PrizeController {

    function GetPrize() {
        $model = new Prize();
        return $model->getPrize();
    }
}
?>