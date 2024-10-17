<?php
require  '../Database.php';
require '../func/functions.php';

// get users in ascending order
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['order'] === 'asc') {
    $users = get_users_asc($pdo);
    header('content-type: application/json', true, 200);
    echo json_encode([
        'users' => $users
    ]);
}
// get users in descending order
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['order'] === 'desc') {
    $users = get_users_desc($pdo);
    header('content-type: application/json', true, 200);
    echo json_encode([
        'users' => $users   
    ]);
}
// get users who registered in the last 24 hours
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['order'] === 'recent') {
    $users = get_users_recent($pdo);
    header('content-type: application/json', true, 200);
    echo json_encode([
        'users' => $users
    ]);
}