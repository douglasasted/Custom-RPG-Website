<?php
    session_start();
    if (!isset($_SESSION["userid"])) 
    {
        header("location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pagina Inicial</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <br>
    <div class="container" style=" background-color: white; 
                                   border-style: outset; 
                                   border-width:medium; 
                                   border-color: grey;">
        <br>
        <?php
            if ($_SESSION["username"] == "Douglas_Asted") 
            {
                echo "<div class='text-center'>< Logado como <a href='index.php'>", $_SESSION["username"], " (GM)</a> ></div>";
            }
            else 
            {
                echo "<div class='text-center'>< Logado como <a href='index.php'>", $_SESSION["username"], "</a> ></div>";
            }
        ?>
        <div class="text-center">( <a href="includes/logout.inc.php" style="color: rgb(0, 0, 161);"> Deslogar </a> )</div>
        <br>