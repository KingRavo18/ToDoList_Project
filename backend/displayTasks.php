<?php 
require '../backend/database.php';

$query = "SELECT id, description FROM tasks";
$result = $mysqli->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='p-3 pl-7 text-[30px] cursor-pointer hover:text-[#15afe2]'>{$row['description']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td class='p-3 pl-7 text-[30px] text-gray-500'>No tasks available</td></tr>";
}

$mysqli->close();