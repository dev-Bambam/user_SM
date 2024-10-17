<?php
// ORDER

// function to get users in ascending order
function get_users_asc($pdo)
{
    $query = "SELECT * FROM users ORDER BY id ASC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
// function to get users in descending order
function get_users_desc($pdo)
{
    $query = "SELECT * FROM users ORDER BY id DESC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
// function to get users who registered in the last 24 hours
function get_users_recent($pdo)
{
    $query = "SELECT * FROM users WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 DAY)";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}