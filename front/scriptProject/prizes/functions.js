/*получить список заявок*/
function getPrize() {
    $.ajax({
        url: 'prizeController.php?GetPrize',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            alert(data);
        },
        error: alert("Ошибка получения приза")
    });
}