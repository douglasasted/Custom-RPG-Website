<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);

$data = $data->roll;

if($data !== null) 
{
    include_once('dbh.inc.php');

    $roll = explode(" ", $data);
    
    $sql = "SELECT * FROM characters WHERE charactersId = ". $roll[1];
    $result = $conn->query($sql);
    $sheet = $result->fetch_assoc();

    $posRolls = array(
        "For" => "Força",
        "Dex" => "Destreza",
        "Con" => "Constituição",
        "Tam" => "Tamanho",
        "Pod" => "Vontade",
        "Car" => "Carisma",
        "Int" => "Inteligência",
        "Edu" => "Educação",
        "Sor" => "Sorte"
    );

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $msg = explode(' ', $sheet['name'])[0] . " : " . $posRolls[$roll[0]] . " " . Roll($sheet["char" . $roll[0]]) . ".";

    echo $sheet["char" . $roll[0]];

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
    header("location: ../login.php");
}