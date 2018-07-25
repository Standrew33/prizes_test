//Get prize
function getPrize(callback) {
    $.ajax({
        url: '../../../back/controllers/prizeController.php?GetPrize',
        type: 'GET',
        async: true,
        success: function (data) {
            callback(JSON.parse(data));
        }
    });
}

//Post prize
function sendPrize(prizeObject, callback) {
    $.ajax({
        url: '../../../back/controllers/prizeController.php',
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
        url: '../../../back/controllers/prizeController.php',
        type: 'POST',
        data:{'ref':'true', 'type': type, 'prize': prize},
        async: true,
        success: function (data) {
            callback(data);
        }
    });
}