<?php
$host = 'localhost';
$db = 'todolist';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

$dbExistsQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'";
$result = $mysqli->query($dbExistsQuery);

if ($result->num_rows === 0) {
    $createDbQuery = "CREATE DATABASE $db";
    if ($mysqli->query($createDbQuery)) {
        
    } else {
        die("Error creating database: " . $mysqli->error);
    }
}

$mysqli->select_db($db);

$tableExistsQuery = "SHOW TABLES LIKE 'tasks'";
$result = $mysqli->query($tableExistsQuery);

if ($result->num_rows === 0) {
    $createTableQuery = "CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        description TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($mysqli->query($createTableQuery)) {
        echo "Table 'tasks' created successfully.";
    } else {
        die("Error creating table: " . $mysqli->error);
    }
}
?>

