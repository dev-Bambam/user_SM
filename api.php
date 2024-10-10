<?php
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate data
    $name = $data['name']?? null;
    $email = $data['email']?? null;
    $password = $data['password']?? null;

    if (!$name || !$email || !$password) {
        // respond with error if validation fails
        header('content-type: application/json', true, 400);
        echo json_encode([
            'error' => 'All fields are required'
        ]);
        exit();
    }

    // insert data into database
    $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $id = $pdo->lastInsertId();

    // respond with success
    header('content-type: application/json', true, 201);
    echo json_encode([
        'message' => "User $name created successfully"
    ]);
}
