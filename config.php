<?php
$db_server= "localhost:3308";
$db_username = "root";
$db_password = "pass";
$db_name = "raamat";

//loome ühendus andmebaasiga
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
//kontrollime ühendust
if ($conn === false ) {
    die("Ei saa ühendust andmebaasiga " . mysqli_connect_error());
}
?>
