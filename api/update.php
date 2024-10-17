<?php
require_once '../Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $name = $data['name'] ?? null;
    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if (!$id || !$name || !$email || !$password) {
        // respond with error if validation fails
        // the  header is use to give the browser informationa about the response 
        header('content-type: application/json', true, 400);
        echo json_encode([
            'error' => 'All fields are required'
        ]);
        exit();
    }
    // update user
    $query = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $count = $statement->rowCount();
    // check if user was updated ==> $count > 0 
    if ($count > 0) {
        // respond with success
        header('content-type: application/json', true, 200);
        echo json_encode([
            'message' => 'User updated successfully'
        ]);
    } else {
        // respond with error
        header('content-type: application/json', true, 404);
        echo json_encode([
            'error' => 'User not found to update'
        ]);
    }
}