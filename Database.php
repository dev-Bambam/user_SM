<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "bambam";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

