<?php
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