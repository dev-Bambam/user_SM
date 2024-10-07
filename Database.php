<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bambam";


$connection = new mysqli($host, $user, $password, $db);

if ($connection->connect_error) {
    die("conection failed:" . $connection->connect_error);
}


$connection->close();