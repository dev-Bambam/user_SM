<?php 
require  '../Database.php';
require '../func/functions.php';


// READ
// get a specific user email or all email 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // get email
    $email = $_GET['email'] ?? null;
    if ($email) {
        // get single user email
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $user_email = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user_email) {
            // respond with success
            header('content-type: application/json', true, 200);
            echo json_encode([
                "email" => $user_email
            ]);
        } else {
            // respond with error
            header('content-type: application/json', true, 404);
            echo json_encode([
                'error' => 'User not found'
            ]);
        }
    } else {
        // get all users
        $query = "SELECT * FROM users";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($users) {
            // respond with success
            header('content-type: application/json', true, 200);
            echo json_encode([
                "users" => $users
            ]);
        } else {
            // respond with error
            header('content-type: application/json', true, 404);
            echo json_encode([
                'error' => 'Users not found'
            ]);
        }
    }
}
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