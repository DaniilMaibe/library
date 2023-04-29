<?php
session_start();
include("db_connect.php");
if (isset($_SESSION['user'])) {
    echo("Имя пользователя: " . $_SESSION['user']['nick']).'<br>';
    $currentUser = $_SESSION['user']['nick'];
} else {
    echo("Вы не авторизированы.");
}

// "SELECT * FROM `history` ORDER BY time DESC LIMIT 1"

  
$resultScan = mysqli_query($db, "SELECT * FROM `history` ORDER BY time DESC LIMIT 1");
$currentBook = 0;
if (mysqli_num_rows($resultScan) > 0){
    while($rowData = mysqli_fetch_assoc($resultScan)){
        echo 'Последняя отсканированная книга: '.'<br>';
        echo 'UID: '.$rowData["uid"].'<br>';
        $currentBook = $rowData["uid"];
    }
    $queryBook = mysqli_query($db, "SELECT * FROM `rfid_uid_name` WHERE `uid`='{$currentBook}'");
    while($rowDataB = mysqli_fetch_assoc($queryBook)){
        echo 'Название: '.$rowDataB["name"].'<br>';
    }
}else {
    echo("Ошибка");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сканирование книги</title>
</head>
<body>
    <?php 
    echo '<h3><a href="scan.php" class="button beer-button-blue">СКАНИРОВАТЬ ЕЩЕ РАЗ</a></h3>';
    ?>
    <form action="" method="POST" target="_self">
    <input type="submit" name="takebook" value="Взять книгу" />
    <input type="submit" name="returnbook" value="Вернуть книгу" />
    </form>
    <?php
    if (isset($_POST['takebook'])) {
        $queryS = mysqli_query($db, "SELECT * FROM `rfid_uid_area` WHERE `uid`='{$currentBook}'");
        if (mysqli_num_rows($queryS) == 0) {
            mysqli_query($db, "INSERT INTO `rfid_uid_area` (`uid`, `area`, `pid`) VALUES ('{$currentBook}', 'Выдано', '{$currentUser}')");
            echo ('Вы успешно взяли книгу');
        } else {
            mysqli_query($db, "UPDATE `rfid_uid_area` SET `area` = 'Выдано', `pid` = '{$currentUser}' WHERE `rfid_uid_area`.`uid` = '{$currentBook}'");
            echo ('Вы успешно взяли книгу');
        }
      }

      if (isset($_POST['returnbook'])) {
        $queryR = mysqli_query($db, "SELECT * FROM `rfid_uid_area` WHERE `uid`='{$currentBook}'");
        if (mysqli_num_rows($queryR) == 0) {
            echo ('Вы не можете вернуть эту книгу, так как её нет в базе данных');
        } else {
            mysqli_query($db, "UPDATE `rfid_uid_area` SET `area` = 'Библиотека', `pid` = '0' WHERE `rfid_uid_area`.`uid` = '{$currentBook}'");
            echo ('Вы успешно вернули книгу');
        }
      }
    ?>
</body>
</html>