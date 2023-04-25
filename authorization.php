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
    echo("Ошибка: Данный логин или пароль неправильны.");
}
