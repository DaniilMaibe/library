<?php
session_start();
include("db_connect.php");
if (isset($_SESSION['user'])) {
    echo("Вы вошли как " . $_SESSION['user']['nick']).'<br>';
} else {
    echo("Вы не авторизированы.");
}

// "SELECT * FROM `history` ORDER BY time DESC LIMIT 1"

  
$resultScan = mysqli_query($db, "SELECT * FROM `history` ORDER BY time DESC LIMIT 1");
if (mysqli_num_rows($resultScan) > 0){
    while($rowData = mysqli_fetch_assoc($resultScan)){
        echo 'Последняя отсканированная книга: '.$rowData["uid"].'<br>';
    }
}else {
    echo("Ошибка");
}
