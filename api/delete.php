<?php
require_once '../Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
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
            'error' => 'User not found to delete',
        ]);
    }
}