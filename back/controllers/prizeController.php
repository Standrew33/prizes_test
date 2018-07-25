<?php
require_once "../Models/Prize.php";

$objPrize = new PrizeController();

if(isset($_GET['GetPrize'])) {
    echo $objPrize->GetPrize();
}

if(isset($_POST['ref'])) {
    echo $objPrize->RefusePrize($_POST['type'], $_POST['prize']);
}

if(isset($_POST['post'])) {
    echo $objPrize->SendPrize($_POST['post']);
}

class PrizeController {

    function GetPrize() {
        $model = new Prize();
        return $model->getPrize();
    }

    function RefusePrize($type, $prize) {
        $model = new Prize();
        return $model->refusePrize($type, $prize);
    }

    function SendPrize($prize) {
        $model = new Prize();
        return $model->sendPrize($prize);
    }
}
?>