<?php
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
        echo 'Please enter valid data';
    } else {
    
        // store user data in database
        $query = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $query->bind_param('sss', $name, $email, $password);
        $query->execute();
        $query->close();

        // redirect to login page
        header('Location: login.php');
        exit;
    }
}
// update user
if(isset($_POST['editUser'])){
    $userId = $_POST['$id'];
    $newUserName = $_POST['$name'];

    $query = $mysqli->prepare("UPDATE users SET name = ? WHERE id = ?");
    $query -> bind_param("si", $newUserName, $userId);
    $query->execute();
    $query->close();

    exit();
}
// delete user
if (isset($_GET['deleteUser'])){
    $userId = $_GET['$id'];

    $query = $mysqli->prepare('DELETE FROM users WHERE id = ?');
    $query->bind_param('i', $userId);
    $query->execute();
    $query->close();
    exit();
}
