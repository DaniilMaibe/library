<?php
session_start();
include("db_connect.php");
if (isset($_SESSION['user'])) {
    echo("Вы вошли как " . $_SESSION['user']['nick']).'<br>';
} else {
    echo("Вы не авторизированы.");
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
echo '<h3><a href="scan.php" class="button beer-button-blue">ВЗЯТЬ КНИГУ</a></h3>';
echo '<h3><a href="exit.php" class="button beer-button-blue">ВЫЙТИ</a></h3>';
?>
</form>
</body>
</html>

