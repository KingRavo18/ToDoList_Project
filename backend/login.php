<?php
session_start();
include "database.php";
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    if (empty($username)) {
        header("Location: ../public/Registration/index.php?login_error=Lietotājvārds ir nepieciešams");
        exit();
    } else if (empty($pass)) {
        header("Location: ../public/Registration/index.php?login_error=Parole ir nepieciešama");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($mysqli, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../public/toDoList.php");
                    exit();
                } else {
                    header("Location: ../public/Registration/index.php?login_error=Nepareizs lietotājvārds vai parole");
                    exit();
                }
            } else {
                header("Location: ../public/Registration/index.php?login_error=Nepareizs lietotājvārds vai parole");
                exit();
            }
        } else {
            header("Location: ../public/Registration/index.php?login_error=Database error");
            exit();
        }
    }
} else {
    header("Location: ../public/Registration/index.php");
    exit();
}