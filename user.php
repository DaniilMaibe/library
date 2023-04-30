<?php
session_start();
include("db_connect.php");
if (isset($_SESSION['user'])) {
    echo("Вы вошли как " . $_SESSION['user']['nick']).'<br>';
    $currentUser = $_SESSION['user']['nick'];
} else {
    echo("Вы не авторизированы.");
}


echo '<b>Список взятых книг: </b>'.'<br>';
$resultAllBooks = mysqli_query($db, "SELECT * FROM `rfid_uid_area` WHERE pid = '{$currentUser}'");
if (mysqli_num_rows($resultAllBooks) > 0){
    while($rowDataA = mysqli_fetch_assoc($resultAllBooks)){
        echo 'UID: '.$rowDataA["uid"].'<br>';
        $currentUID = $rowDataA["uid"];
        $resultAllBooksName = mysqli_query($db, "SELECT * FROM `rfid_uid_name` WHERE uid = '{$currentUID}'");
        $rowDataAN = mysqli_fetch_assoc($resultAllBooksName);
        if ($rowDataAN == null){
            echo 'Ошибка. Такой книги нет в базе данных'.'<br>';
        } else {
            echo 'Название: '.$rowDataAN["name"].'<br>';
        }
        echo '<br>';
    }
}else {
    echo("У Вас не обнаружено ни одной взятой книги");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню</title>
</head>
<body>
<?php 
echo '<h3><a href="scan.php" class="button beer-button-blue">ВЗЯТЬ/СДАТЬ КНИГУ</a></h3>';
echo '<h3><a href="exit.php" class="button beer-button-blue">ВЫЙТИ</a></h3>';
?>
</form>
</body>
</html>

