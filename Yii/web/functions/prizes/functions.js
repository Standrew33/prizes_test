//Get prize
function getPrize(callback) {
    $.ajax({
        url: '../../../Yii/controllers/prizeController.php?GetPrize',
        type: 'GET',
        async: true,
        success: function (data) {
            callback(JSON.parse(data));
        }
    });
}

//Convert money to bonus
function convertMoney(money, coef, callback) {
    $.ajax({
        url: '../../../Yii/controllers/prizeController.php?money=' + money + "&coef=" + coef,
        type: 'GET',
        async: true,
        success: function (data) {
            callback(data);
        }
    });
}

//Post prize
function sendPrize(prizeObject, callback) {
    $.ajax({
        url: '../../../Yii/controllers/prizeController.php',
        type: 'POST',
        data:{'post': prizeObject},
        async: true,
        success: function (data) {
            callback(data);
        }
    });
}

//Refuse prize
function refusePrize(type, prize, callback) {
    $.ajax({
        url: '../../../Yii/controllers/prizeController.php',
        type: 'POST',
        data:{'ref':'true', 'type': type, 'prize': prize},
        async: true,
        success: function (data) {
            callback(data);
        }
    });
}