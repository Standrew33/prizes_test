<?php
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'PrizeTest - Main';

if (\Yii::$app->getUser()->isGuest &&
    \Yii::$app->getRequest()->url !== Url::to(\Yii::$app->getUser()->loginUrl)
) {
    \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
}

?>

<div class="site-index">

    <div class="jumbotron">
        <p class="lead">Click to get prize</p>
        <?php
            Modal::begin([
                'options' => ['id' => 'myModal'],
                'header' => '<h2 id="modalHeader"></h2>',
                'toggleButton' => [
                    'id' => 'btPrize',
                    'label' => 'Get prize!',
                    'tag' => 'button',
                    'class' => 'btn btn-lg btn-success',
                ],
                'footer' => '<h3>
                                <button class="btn btn-lg btn-success" data-dismiss="modal" id="btPost">Send</button>
                                <button class="btn btn-lg btn-success" data-dismiss="modal" id="btRef">Refuse</button>
                                <button class="btn btn-lg btn-success" data-dismiss="modal" id="btOk">Ok</button>
                            </h3>',
                'closeButton' => false,
                'clientOptions' => [
                    'backdrop' => 'static',
                    'keyboard' => false,
                ],
            ]);
            echo '<p id="modalText"></p>';
            echo '<input type="checkbox" id="modalConvert"/><label id="labelConvert"> Convert to bonuses?</label>';

            Modal::end();
        ?>
    </div>

    <div class="body-content">
        <div class="row">
            <h1>Today you won</h1>
            <div class="col-lg-4">
                <h2>Money prize: </h2>
                <p id="totalMoney">0</p>
            </div>
            <div class="col-lg-4">
                <h2>Bonus prize: </h2>
                <p id="totalBonus">0</p>
            </div>
            <div class="col-lg-4">
                <h2>Subject prize: </h2>
                <p id="totalSubject"></p>
            </div>
        </div>
    </div>
</div>

<script>
    var prizeObject;

    var modal = document.getElementById('myModal');
    var headerModal = document.getElementById('modalHeader');
    var textModal = document.getElementById('modalText');

    var totalMoney = document.getElementById('totalMoney');
    var totalBonus = document.getElementById('totalBonus');
    var totalSubject = document.getElementById('totalSubject');

    $("#btPrize").on("click", function() {
        getPrize(function (data) {
            var typePrize;
            prizeObject = data;
            switch (data.type) {
                case 1:
                    typePrize = "Money prize";
                    break;
                case 2:
                    typePrize = "Bonus prize";
                    break;
                case 3:
                    typePrize = "Subject prize";
                    break;
                default:
                    break;
            }

            if (data.prize && data.prize != 0)
            {
                headerModal.innerText = "Congratulations! You received " + typePrize;
                if (data.type == 1){
                    $("#modalConvert").show();
                    $("#labelConvert").show();
                }
                else {
                    $("#modalConvert").hide();
                    $("#labelConvert").hide();
                }
                $("#btPost").attr("disabled", false);
                if (data.type != 2)
                    $("#btRef").attr("disabled", false);
                else $("#btRef").attr("disabled", true);
                $("#btOk").hide();
            }
            else
            {
                headerModal.innerText = "We are sorry, you received a prize, which has already ended today. (" + typePrize + ")";
                $("#modalConvert").hide();
                $("#labelConvert").hide();
                $("#btPost").attr("disabled", true);
                $("#btRef").attr("disabled", true);
                $("#btOk").show();
            }

            textModal.innerText = "You received: " + data.prize;
        });
    });

    $("#btPost").on("click", function() {
        if($("#modalConvert").is(':checked'))
        {
            convertMoney(prizeObject.prize, 2, function (data) {
                prizeObject.prize = data;
                prizeObject.type = 2;

                totalBonus.innerText = parseInt(totalBonus.innerText) + parseInt(prizeObject.prize);
                alert("Points are successfully added to the mobile app");

                sendPrize(prizeObject, function (data) {});
            });
        }
        else
            sendPrize(prizeObject, function (data) {
                if (data)
                    switch (prizeObject.type) {
                        case 1:
                            totalMoney.innerText = parseInt(totalMoney.innerText) + prizeObject.prize;
                            alert("The money was successfully transferred to the bank account");
                            break;
                        case 2:
                            totalBonus.innerText = parseInt(totalBonus.innerText) + prizeObject.prize;
                            alert("Points are successfully added to the mobile app");
                            break;
                        case 3:
                            totalSubject.innerText += (prizeObject.prize + ";");
                            alert("The prize was successfully sent by mail");
                            break;
                        default:
                            break;
                    }
            });
    });

    $("#btRef").on("click", function() {
        refusePrize(prizeObject.type, prizeObject.prize, function (data) {
            if (data) alert("The prize was successfully returned.");
        });
    });
</script>
