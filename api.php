<?php
require 'Database.php';

// CREATE

// create user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // collecting the data coming from client and converting it to json and storing it in $data which will be stored as array
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate data
    $name = $data['name']?? null;
    $email = $data['email']?? null;
    $password = $data['password']?? null;

    if (!$name || !$email || !$password) {
        // respond with error if validation fails
        // the  header is use to give the browser informationa about the response 
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
    }else {
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

// UPDATE

// update user
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id']?? null;
    $name = $data['name']?? null;
    $email = $data['email']?? null;
    $password = $data['password']?? null;
    
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
    // check if user was updated
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

// DELETE

// delete user
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id']?? null;
    if (!$id) {
        // respond with error if validation fails
        // the  header is use to give the browser informationa about the response 
        header('content-type: application/json', true, 400);
        echo json_encode([
            'error' => 'All fields are required'
        ]);
        exit();
    }
    // delete user
    $query = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $count = $statement->rowCount();
    // check if user was deleted
    if ($count > 0) {
        // respond with success
        header('content-type: application/json', true, 200);
        echo json_encode([
            'message' => 'User deleted successfully'
        ]);
    } else {
        // respond with error
        header('content-type: application/json', true, 404);
        echo json_encode([
            'error' => 'User not found to delete'
        ]);
    }
}
