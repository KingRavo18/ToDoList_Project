<?php
require 'database.php';
header('Content-Type: application/json');
if (isset($_GET['id'])) {
    $taskId = intval($_GET['id']);
    $query = "DELETE FROM tasks WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param('i', $taskId);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $mysqli->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to prepare statement.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
$mysqli->close();