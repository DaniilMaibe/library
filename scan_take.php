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
        <h1 class="mx-auto" style="padding-bottom: 50px;">Взять книгу</h1>
        
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
            if (mysqli_num_rows($queryBook) > 0){
                while($rowDataB = mysqli_fetch_assoc($queryBook)){
                   // echo 'Название: '.$rowDataB["name"].'<br>';?>
                <div class="row">
                    <div class="mx-auto" style="padding-bottom: 30px; font-weight:600; font-size: 30px"><?=$rowDataB["author"]?> — "<?=$rowDataB["name"]?>"</div>
                </div>
                <div class="row">
                    <h3 class="mx-auto">Вы хотите взять эту книгу?</h3>
                </div>
                
                <?php }
                 //echo '<form action="" method="POST" target="_self">';
                //echo '<input type="submit" name="takebook" value="Взять книгу" />';
                //echo '</form>';
                
            }else {
                //echo("Ошибка. Вы не можете взять эту книгу, так как она не зарегистрирована в базе данных. Обратитесь к сотруднику библиотеки.");?>
                <div class="message_scan">Вы не можете взять эту книгу, так как она не зарегистрирована в базе данных. Обратитесь к сотруднику библиотеки.</div>
                <?php
            }
        }
            //echo '<h3><a href="scan_take.php" class="button beer-button-blue">СКАНИРОВАТЬ ЕЩЕ РАЗ</a></h3>';
            if (isset($_POST['takebook'])) {
                $queryS = mysqli_query($db, "SELECT * FROM `rfid_uid_area` WHERE `uid`='{$currentBook}'");
                if (mysqli_num_rows($queryS) == 0) {
                    mysqli_query($db, "INSERT INTO `rfid_uid_area` (`uid`, `area`, `pid`, `date_take`) VALUES ('{$currentBook}', 'Выдано', '{$currentUser}', NOW() )");
                    //echo ('Вы успешно взяли книгу');?>
                    <div class="message_scan">Вы успешно взяли книгу</div>
                    <?php
                } else {
                    mysqli_query($db, "UPDATE `rfid_uid_area` SET `area` = 'Выдано', `pid` = '{$currentUser}', `date_take` = NOW() WHERE `rfid_uid_area`.`uid` = '{$currentBook}'");
                    //echo ('Вы успешно взяли книгу');?>
                    <div class="message_scan">Вы успешно взяли книгу</div>
                    <?php
                }
            }
            //echo '<h3><a href="user.php" class="button beer-button-blue">НАЗАД</a></h3>';
    ?>

        <div class="row" style="padding-top: 40px">
            <div class="col-6">
                <form method="POST" target="_self">
                    <div class="input-form" style="width: 25%; margin-right: auto; margin-left: auto">
                        <input style="margin-top: 0px;" type="submit" name="takebook" value="Да">
                    </div>
                </form>
            </div>
            
            <div class="col-6" >
                <div class="input-form" style="margin-top:20px">
                    <a class="button_user" href="scan_take.html" role="button">Нет, сканировать еще раз</a>
                </div>
            </div>
        </div>

</body>
</html>