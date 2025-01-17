<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['description'])) {
    $id = intval($_POST['id']);
    $description = $mysqli->real_escape_string($_POST['description']);

    $query = "UPDATE tasks SET description = '$description' WHERE id = $id";
    if ($mysqli->query($query)) {
        echo "Task updated successfully.";
    } else {
        echo "Error updating task: " . $mysqli->error;
    }
}

$mysqli->close();