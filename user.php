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
echo '<table bordercolor="black" border="1" width="30%">';
$resultAllBooks = mysqli_query($db, "SELECT * FROM `rfid_uid_area` WHERE pid = '{$currentUser}'");
if (mysqli_num_rows($resultAllBooks) > 0){
    while($rowDataA = mysqli_fetch_assoc($resultAllBooks)){
        // echo 'UID: '.$rowDataA["uid"].'<br>';
        $currentUID = $rowDataA["uid"];
        $resultAllBooksName = mysqli_query($db, "SELECT * FROM `rfid_uid_name` WHERE uid = '{$currentUID}'");
        $rowDataAN = mysqli_fetch_assoc($resultAllBooksName);
        if ($rowDataAN == null){
            echo 'Ошибка. Такой книги нет в базе данных'.'<br>';
        } else {
            // echo 'Название: '.$rowDataAN["name"].'<br>';
            echo '<tr>';
            echo '<td>'.$rowDataAN["name"].'</td>';
            echo '<td>'.$rowDataA["date_take"].'</td>';
            // для вычисления дедлайна добавляем две недели
            $newDate = new DateTime($rowDataA["date_take"]);
            $newDate->add(new DateInterval('P14D')); // P14D means a period of 14 days
            $deadline = $newDate->format('Y-m-d');
            echo '<td>'.$deadline.'</td>';
            echo '</tr>';
        }
        echo '<br>';
    }
}else {
    echo("У Вас не обнаружено ни одной взятой книги");
}
echo '</table>';


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
echo '<h3><a href="scan_take.php" class="button beer-button-blue">ВЗЯТЬ КНИГУ</a></h3>';
echo '<h3><a href="scan_return.php" class="button beer-button-blue">ВЕРНУТЬ КНИГУ</a></h3>';
echo '<h3><a href="exit.php" class="button beer-button-blue">ВЫЙТИ</a></h3>';
?>

</form>
</body>
</html>

