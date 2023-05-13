<?php
session_start();
include("db_connect.php");


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
            <a class="navbar-brand js-scroll-trigger" href="index.html" style="font-weight: bold;"><img class="logo" src="img/logo.png" alt="3D MIEM">БИБЛИОТЕКА МИЭМ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" id="menu">
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="index.html" >Главная</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="manual.html">Инструкция</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="user.php" style="font-weight:bold;">Личный кабинет</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="exit.php">Выйти</a> </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="row" style="padding-top: 80px;">
        <div class="col-6">
        <?php
            if (isset($_SESSION['user'])) {
                $currentUser = $_SESSION['user']['nick'];
                $resultAllUser = mysqli_query($db, "SELECT * FROM `person_info` WHERE phone = '{$currentUser}'");
                $rowDataAU = mysqli_fetch_assoc($resultAllUser);?>

                <div style="font-weight: 600; font-size: 30px"><?=$rowDataAU["last_name"]?> <?=$rowDataAU["first_name"]?> <?=$rowDataAU["patronymic"]?></div>
                <div style="font-size: 18px"><?=$rowDataAU["phone"]?></div>
                <div style="font-size: 18px"><?=$rowDataAU["email"]?></div>

            <?php } else {
                echo("Вы не авторизированы.");
            }
        ?>
        </div>
        <div class="col-6">
            <div class="row" style="margin-top: 30px; ">
                <div class="mx-auto">
                    <a class="button_user"  href="scan_take.html" role="button">Взять книгу</a>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="mx-auto">
                    <a class="button_user" href="scan_return.html" role="button">Вернуть книгу</a>
                </div>
            </div>
        </div>
        

        
    </div>
    <div class="row">
        
        
    </div>
    <div class="row">
        <h2>Список взятых книг: </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Автор</th>
                <th scope="col">Название</th>
                <th scope="col">Дата взятия</th>
                <th scope="col">Дата возврата </th>
                </tr>
            </thead>
            <tbody>
        <?php
            $resultAllBooks = mysqli_query($db, "SELECT * FROM `rfid_uid_area` AS rua 
            LEFT JOIN `rfid_uid_name` AS run ON rua.uid = run.uid
            WHERE pid = '{$currentUser}'");
            //$rowDataA = mysqli_fetch_assoc($resultAllBooks);
            foreach ($resultAllBooks as $f) {

                $newDate = new DateTime($f["date_take"]);
                $newDate->add(new DateInterval('P14D')); // P14D means a period of 14 days
                $deadline = $newDate->format('d-m-Y');
            
                ?>
                <tr>
                    <td><?=$f['uid'] ?></td>
                    <td><?=$f['author'] ?></td>
                    <td><?=$f['name'] ?></td>
                    <td><?=$f['date_take'] ?></td>
                    <td><?=$deadline?></td>
                </tr>
                
    <?php }?>  



             
            </tbody>
        </table>
                        
                        
    </div>
    
    

    
</body>
</html>

