<?php 
require 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $mysqli->real_escape_string(trim($_POST['contents']));
    if (!empty($content)) {
        $query = "INSERT INTO tasks (description) VALUES ('$content')";
        if ($mysqli->query($query)) {
            header('Location: ../public/toDoList.php');
            exit;
        } else {
            echo 'Error: ' . $mysqli->error;
        }
    } else {
        echo 'Task content cannot be empty.';
    }
} else {
    echo 'Invalid request method.';
}
$mysqli->close();