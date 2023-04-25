<?php
session_start();
include("db_connect.php");
$login = $_POST['login'];
$password = $_POST['password'];
//$md5_password = md5($password);
$query = mysqli_query($db, "SELECT * FROM `authorization` WHERE `login`='{$login}'");
if (mysqli_num_rows($query) == 0) {
    $_SESSION['user'] = ['nick' => $login];
    mysqli_query($db, "INSERT INTO `authorization` (`login`, `password`) VALUES ('{$login}', '{$password}')");
    header("Location: user.php");
} else {
    echo("Ошибка: Данный телефон уже был зарегистрирован.");
}