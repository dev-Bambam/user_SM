<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
        echo 'Please enter valid data';
    }
}