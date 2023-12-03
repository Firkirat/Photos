<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "Photos";


$conn = new mysqli($server, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->set_charset("utf8");
?>

