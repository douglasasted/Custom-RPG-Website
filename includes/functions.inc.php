<?php

// Signup Functions

function nameExist($conn, $name, $email)
{
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else 
    {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $pwd)
{
    $sql = "INSERT INTO users(usersName, usersEmail, usersPwd) VALUES(?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();
}

// Login Functions
function loginUser($conn, $name, $pwd) 
{
    $nameExist = nameExist($conn, $name, $name);

    if ($nameExist === false) 
    {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $nameExist["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) 
    {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) 
    {
        session_start();
        $_SESSION["userid"] = $nameExist["usersId"];
        $_SESSION["username"] = $nameExist["usersName"];

        header("location: ../index.php");
        exit();
    }
}