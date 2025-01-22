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
    function isValidPassword($password) {
        if (strlen($password) < 8) {
            return false;
        }
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }
        if (!preg_match('/[\W]/', $password)) { 
            return false;
        }
        return true;
    }
    if (empty($username)) {
        header("Location: ../public/Registration/signUp.php?signup_error=Lietotājvārds ir nepieciešams");
        exit();
    } else if (empty($pass)) {
        header("Location: ../public/Registration/signUp.php?signup_error=Parole ir nepieciešama");
        exit();
    } else if (!isValidPassword($pass)) {
        header("Location: ../public/Registration/signUp.php?signup_error=Parolei jābūt vismaz 8 rakstzīmēm, jāiekļauj vismaz viens lielais burts, viens mazais burts, viens cipars un viena speciālā rakstzīme");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($mysqli, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username,);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                header("Location: ../public/Registration/signUp.php?signup_error=Lietotājvārds vai E-pasts jau eksistē");
                exit();
            } else {
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt_insert = mysqli_prepare($mysqli, $sql_insert);
                if ($stmt_insert) {
                    mysqli_stmt_bind_param($stmt_insert, "ss", $username, $hashed_pass);
                    mysqli_stmt_execute($stmt_insert);
                    $new_user_id = mysqli_insert_id($mysqli);
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['id'] = $new_user_id; 
                    header("Location: ../public/Registration/index.php");
                    exit();
                } else {
                    header("Location: ../public/Registration/signUp.php?signup_error=Database error during insertion");
                    exit();
                }
            }
        } else {
            header("Location: ../public/Registration/signUp.php?signup_error=Database error");
            exit();
        }
    }
} else {
    header("Location: ../public/Registration/signUp.php");
    exit();
}

