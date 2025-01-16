<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>To Do List</title>
</head>
<body class="flex flex-col min-h-screen">
    <main class="flex flex-grow justify-center items-center">
        <div class="bg-white w-[600px] h-[360px]">
            <div class="flex bg-[#0a779b] w-full h-[80px] text-white items-center">
                <div>
                    <h1 class="pl-[20px] text-[40px]">TO-DO LIST</h1>
                </div>
                <div>
                    <p class="ml-[301px] text-[60px] cursor-pointer transition-all duration-800 font-bold hover:text-[gray]" onclick="showAddTaskPopup()">+</p>
                </div>
            </div>
            <div class="w-full h-[280px] overflow-y-auto border-t border-gray-300">
                <table class="w-full">
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
                    ?>
                </table>
            </div>
        </div>
        <div id="AddTaskPopupFullPage" class="fixed hidden w-full h-full bg-[rgba(0,_0,_0,_0.5)] z-1 bottom-0">
            <div id="AddTaskPopup" class="fixed bg-white w-[400px] h-[180px] top-2/4 left-2/4 -translate-x-1/2 -translate-y-1/2 opacity-0 scale-95 transition-all duration-500 ease-out">
                <div class="absolute right-1 top-1">
                    <i class="material-icons cursor-pointer transition-all duration-800 hover:text-[gray]" onclick="hideAddTaskPopup()">close</i>
                </div>
                <div class="absolute top-10 w-full">
                    <form action="../backend/createTask.php" class="flex flex-col items-center gap-4" method="POST">
                        <input type="text" name="contents" class="w-[300px]" required>
                        <button class="p-2 bg-[rgb(216,_216,_216)] transition-all mt-[20px] duration-800 hover:bg-[rgb(170,_170,_170)]">Create Task</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="bottom-[0] bg-white h-[100px]">
    </footer>
    <script src="popup.js"></script>
</body>
</html>
