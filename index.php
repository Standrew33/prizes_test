<?php
include_once ('enter.php');

if (!$UID) header("Location: enter.php");
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PrizeTest - Главная</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,900" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/media.css">

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/front/scriptProject/prizes/functions.js"></script>
</head>
<body>
    <a href="enter.php?action=out">Выход</a><br>
    <label>
        Нажмите чтобы получить приз
    </label><br>
    <button onclick="getPrize()">
        Получить приз
    </button>
</body>
</html>