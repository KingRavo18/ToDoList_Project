<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/Registration/index.php");
    exit();
}

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contents'])) {
    $user_id = $_SESSION['user_id'];
    $task = $mysqli->real_escape_string($_POST['contents']);

    $sql = "INSERT INTO tasks (user_id, description) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('is', $user_id, $task);
        $stmt->execute();
        $stmt->close();
        header("Location: ../public/toDoList.php");
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>