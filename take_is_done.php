<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("db_connect.php");
        include("scan.php");
        mysqli_query($db, "INSERT INTO `rfid_uid_area` (`uid`, `area`, `pid`) VALUES ('1', '1', '1')");
    ?>
</body>
</html>

// mysqli_query($db, "INSERT INTO `authorization` (`login`, `password`) VALUES ('{$login}', '{$password}')");