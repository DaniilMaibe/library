<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container auth">

    <header class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3" id="mainNav">
        <div class="container"> 
            <a class="navbar-brand js-scroll-trigger" href="manual.html" style="font-weight: bold;"><img class="logo" src="img/logo.png" alt="3D MIEM">БИБЛИОТЕКА МИЭМ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" id="menu">
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="manual.html">Инструкция</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="auth.html"  style="font-weight:bold;">Войти</a> </li>
                </ul>
            </div>
        </div>
    </header>
   
    <div class="row rowauth">
        <div class="col-lg-4 col-md-3 col-sm-1"></div>
        <div class="col-lg-4 col-md-6 col-sm-10">
            <form style="padding-bottom: 0px;" class="form" action="authorization.php" method="post">
                <h1>Авторизация</h1>
                <div class="input-form inp_auth">
                    <input type="text" placeholder="Телефон (89991234567)" pattern="8[0-9]{10}" name="login">
                </div>
                <div class="input-form inp_auth">
                    <input type="password" placeholder="Пароль" name="password">
                </div>
                <?php
                session_start();
                include("db_connect.php");
                $login = $_POST['login'];
                $password = $_POST['password'];
                // $md5_password = md5($password);

                $resultAll = mysqli_query($db, "SELECT * FROM `authorization` WHERE `login`='{$login}' AND `password`='{$password}'");

                if (mysqli_num_rows($resultAll) > 0){
                    while($rowData = mysqli_fetch_assoc($resultAll)){
                        echo $rowData["category_name"].'<br>';
                        $_SESSION['user'] = ['nick' => $login];
                        header("Location: user.php");
                    }
                }else {
                    echo '<div style="padding: 0;
                    text-align: center;
                    color: #fff;">'.'Неправильный логин или пароль.'.'</div>';
                }
                ?>
                <div class="input-form" style="margin-bottom: 0px;">
                    <input type="submit" value="Войти">
                </div>
            </form>
            <form style="padding-top: 0px;" class="form" action="registration.html" method="get">
                <div class="input-form" style="margin-top: 0px;">
                    <input type="submit" value="Регистрация">
                </div>
            </form>
                
            
        </div>
        <div class="col-lg-4 col-md-3 col-sm-1"></div>
    </div>

    
</body>
</html>

