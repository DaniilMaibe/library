<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="auth.html"  style="font-weight:bold;">Войти</a> </li>
                </ul>
            </div>
        </div>
    </header>
   
    <div class="row rowauth">
        <div class="col-lg-3 col-md-3 col-sm-1"></div>
        <div class="col-lg-6 col-md-6 col-sm-10">
            <form action="registration.php" method="post">
                <h1 style="text-align:center; padding-bottom: 10px;">Регистрация</h1>
                <div class="input-form inp_reg">
                    <input name="last_name" type="text" placeholder="Фамилия" required>
                </div>
                <div class="input-form inp_reg">
                    <input name="first_name" type="text" placeholder="Имя" required>
                </div>
                <div class="input-form inp_reg">
                    <input name="patronymic" type="text" placeholder="Отчество">
                </div>
                <div class="input-form inp_reg">
                    <input name="email" type="email" placeholder="Почта" required>
                </div>
                
                <div class="input-form inp_reg">
                    <input name="login" type="tel" pattern="8[0-9]{10}" placeholder="Телефон (89991234567)" required>
                </div>
                <div class="input-form inp_reg">
                    <input name="password" type="password" placeholder="Пароль" required>
                </div>

                <?php
                session_start();
                include("db_connect.php");
                $login = $_POST['login'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $patronymic = $_POST['patronymic'];
                //$md5_password = md5($password);
                $query = mysqli_query($db, "SELECT * FROM `authorization` WHERE `login`='{$login}'");
                if (mysqli_num_rows($query) == 0) {
                    $_SESSION['user'] = ['nick' => $login];
                    mysqli_query($db, "INSERT INTO `authorization` (`login`, `password`) VALUES ('{$login}', '{$password}')");
                    mysqli_query($db, "INSERT INTO `person_info` (`phone`, `first_name`, `last_name`, `patronymic`, `email`) VALUES ('{$login}', '{$first_name}', '{$last_name}', '{$patronymic}', '{$email}')");
                    header("Location: user.php");
                } else {
                    echo '<div style="padding: 0;
                    text-align: center;">'.'Ошибка: Данный телефон уже зарегистрирован.'.'</div>';
                }

                ?>

                <div class="input-form">
                    <input type="submit" style="margin-top:0px" value="Зарегистрироваться">
                </div>

                
            </form>
        </div>
        <div class="col-lg-3s col-md-3 col-sm-1"></div>
    </div>



</body>
</html>

