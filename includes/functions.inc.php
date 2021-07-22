<?php

// Funções de Criação de Conta
function nameExist($conn, $name)
{
    $sql = "SELECT * FROM users WHERE usersName = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 's', $name);
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

function createUser($conn, $name, $pwd)
{
    $sql = "INSERT INTO users(usersName, usersPwd) VALUES(?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $name, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();
}

// Funções de Login
function loginUser($conn, $name, $pwd) 
{
    $nameExist = nameExist($conn, $name);

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

// Funções para o RPG
function Roll($value) 
{
    $quality = "Fracassso";
    $rng = random_int(1, 20);

    if ($rng == 1) 
    {   
        if ($value < 20) 
        {
            $quality = "Desastre";
        }
    }
    else if ($rng > 20 - floor($value / 4))
    {
        $quality = "Extremo";

        if ($rng == 20) 
        {
            $quality = "Milagre";
        }
    }
    else if ($rng > 20 - floor($value / 2)) 
    {
        $quality = "Bom";
    }
    else if ($rng >= 20 - $value) 
    {
        $quality = "Normal";
    }

    $val = " (". $value . ") ";

    if ($_SESSION["username"] == "Douglas_Asted") 
    {
        $val = " ";
    }

    return $rng . $val . $quality;
}

function RollExp($value) 
{
    $quality = "Fracasso";
    $rng = random_int(1, 100);

    if ($rng <= $value) 
    {
        $quality = "Sucesso";
    }

    return $rng . " (". $value . ") " . $quality;
}

function RollGen($value) 
{
    $value = explode(' ', $value);
    $total = 0;
    $msg = "";
    $lastchar = '';

    foreach ($value as $val) 
    {
        if (is_numeric($val)) 
        {
            if ($lastchar == '-')
            {
                $msg = $msg . " - " . $val;
                $total -= (int) $val;
            }
            else 
            {
                $msg = $msg . " + " . $val;
                $total += (int) $val;   
            }
        }
        else if ($val == '+') 
        {
            $lastchar = '+';
        }
        else if ($val == '-')
        {
            $lastchar = '-';
        }
        else 
        {
            $roll = explode('d', $val);
            $rollmsg = "";
            $totalroll = 0;
            
            for ($i=0; $i < $roll[0]; $i++) 
            {
                $rng = random_int(1, $roll[1]);
                $rollmsg = $rollmsg . " + " . $rng;
                $totalroll += $rng;
            }

            $msg = $msg . " + " . $totalroll . " (  " . substr($rollmsg, 2) . " )";
            $total += $totalroll;
        }
    }

    return $total . ' = ' . substr($msg, 2);
}