<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);

$data = $data->roll;

if($data !== null) 
{
    $roll = explode(" ", $data);
    $posRolls = array(
        "FOR" => "Força",
        "DEX" => "Destreza",
        "CON" => "Constituição",
        "TAM" => "Tamanho",
        "POD" => "Vontade",
        "CAR" => "Carisma",
        "INT" => "Inteligência",
        "EDU" => "Educação",
        "SOR" => "Sorte"
    );

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $msg = $posRolls[$roll[0]] . " " . Roll($roll[1]);

    $name = mysqli_real_escape_string($conn, $_SESSION['username']);
    $msg = mysqli_real_escape_string($conn, $msg);

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d-m-y h:ia');

    $sql = "INSERT INTO chat (chatUName, chatMsg, chatDt) VALUES ('$name', '$msg', '$date');";
    if(mysqli_query($conn, $sql))
    {
        ;
    } 
    else
    {
        echo "Erro: Mensagem não enviada!";
    }
}
else 
{
    echo "problema";
    header("location: ../login.php");
}