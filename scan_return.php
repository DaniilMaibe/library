<?php
session_start();
include("db_connect.php");
if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user']['nick'];
} else {
    echo("Вы не авторизированы.");
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body class="container">

    <header class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3" id="mainNav">
        <div class="container"> 
            <a class="navbar-brand js-scroll-trigger" href="manual.html" style="font-weight: bold;"><img class="logo" src="img/logo.png" alt="3D MIEM">БИБЛИОТЕКА МИЭМ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" id="menu">
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="manual.html">Инструкция</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="user.php" style="font-weight:bold;">Личный кабинет</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="exit.php">Выйти</a> </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="row" style="padding-top: 80px;">
        <h1 class="mx-auto" style="padding-bottom: 50px;">Вернуть книгу</h1>
    </div>

    <?php 
    $resultScan = mysqli_query($db, "SELECT * FROM `history` ORDER BY time DESC LIMIT 1");
    $currentBook = 0;
    if (mysqli_num_rows($resultScan) > 0){
        while($rowData = mysqli_fetch_assoc($resultScan)){
            //echo 'Последняя отсканированная книга: '.'<br>';
            //echo 'UID: '.$rowData["uid"].'<br>';
            $currentBook = $rowData["uid"];
        }
        $queryBook = mysqli_query($db, "SELECT * FROM `rfid_uid_name` WHERE `uid`='{$currentBook}'");
        while($rowDataB = mysqli_fetch_assoc($queryBook)){
            //echo 'Название: '.$rowDataB["name"].'<br>';?>
            <div class="row">
                <div class="mx-auto" style="padding-bottom: 30px; font-weight:600; font-size: 30px"><?=$rowDataB["author"]?> — "<?=$rowDataB["name"]?>"</div>
            </div>
            <div class="row">
                <h3 class="mx-auto">Вы хотите вернуть эту книгу?</h3>
            </div>
            <?php
        }
    }else {
        //echo("Ошибка");?>
        <div class="message_scan">Ошибка. Обратитесь к сотруднику библиотеки.</div>
        <?php
    }
    if (isset($_POST['returnbook'])) {
        $queryR = mysqli_query($db, "SELECT * FROM `rfid_uid_area` WHERE `uid`='{$currentBook}' and `pid` = '{$currentUser}'");
        if (mysqli_num_rows($queryR) == 0) {
            //echo ('Вы не можете вернуть эту книгу, так как её нет в базе данных или она взята не Вами');?>
            <div class="message_scan">Книга не найдена среди взятых вами. Обратитесь к сотруднику библиотеки.</div>
            <?php 
        } else {
            mysqli_query($db, "UPDATE `rfid_uid_area` SET `area` = 'Библиотека', `pid` = '0', `date_take` = '0000-00-00' WHERE `rfid_uid_area`.`uid` = '{$currentBook}'");
            //echo ('Вы успешно вернули книгу');?>
            <div class="message_scan">Вы успешно вернули книгу</div>
            <?php 
        }    
    }
    ?>

        <div class="row" style="padding-top: 40px">
            <div class="col-6">
                <form method="POST" target="_self">
                    <div class="input-form" style="width: 25%; margin-right: auto; margin-left: auto">
                        <input style="margin-top: 0px;" type="submit" name="returnbook" value="Да">
                    </div>
                </form>
            </div>
            
            <div class="col-6" >
                <div class="input-form" style="margin-top:20px">
                    <a class="button_user" href="scan_return.html" role="button">Нет, сканировать еще раз</a>
                </div>
            </div>
        </div>
    <?php

      
    ?>
</body>
</html>