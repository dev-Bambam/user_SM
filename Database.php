<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "bambam";


$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_error) {
    die("conection failed: $mysqli->connect_error");
}


// $mysqli->close();