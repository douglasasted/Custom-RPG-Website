<?php
session_start();
$json = file_get_contents('php://input');

include_once('dbh.inc.php');

$sql = "INSERT INTO characters (charactersName, charactersPlayer) VALUES ('???', 'douglas_asted');";

if(mysqli_query($conn, $sql))
    ;
else
    echo "Erro: Personagem não inserido!";