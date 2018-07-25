<?php
include_once ('enter.php');

//if (!$UID) header("Location: enter.php");

if($UID)
{?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PrizeTest - Main</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,900" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/front/scriptProject/prizes/functions.js"></script>


</head>
<body>
    <a href="enter.php?action=out">Выход</a><br>
    <label>
        Click to get prize
    </label><br>
    <button id="btPrize">
        Get prize!
    </button><br><br>
    <label>Today you won</label><br><br>
    <label>Money prize: </label><p id="totalMoney">0</p><br>
    <label>Bonus prize: </label><p id="totalBonus">0</p><br>
    <label>Subject prize: </label><p id="totalSubject"></p><br>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalHeader"></h2>
            </div>
            <div class="modal-body">
                <br><p id="modalText"></p><br>
                <input type="checkbox" id="modalConvert"/><label id="labelConvert"> Convert to bonuses?</label><br><br>
            </div>
            <div class="modal-footer">
                <h3>
                    <button id="btPost">Post</button>
                    <button id="btRef">Refuse</button>
                    <button id="btOk">Ok</button>
                </h3>
            </div>
        </div>
    </div>
</body>
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

            modal.style.display = "block";
        });
    });

    $("#btPost").on("click", function() {
        modal.style.display = "none";
        if($("#modalConvert").is(':checked'))
        {
            prizeObject.type = 2;
            prizeObject.prize *= 2;
        }
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
        modal.style.display = "none";

        refusePrize(prizeObject.type, prizeObject.prize, function (data) {
            if (data) alert("The prize was successfully returned.");
        });
    });

    $("#btOk").on("click", function() {
        modal.style.display = "none";
    });
</script>
</html>
<?}