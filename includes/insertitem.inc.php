<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);

$id = $data->id;
$type = $data->type;

if($id !== null) 
{
    include_once('dbh.inc.php');

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d-m-y h:i:sa');

    if ($type == "inventory") 
    {
        $sql = "INSERT INTO inventory (charactersId) VALUES ('$data->id');";
    }
    else 
    {
        $sql = "INSERT INTO guns (charactersId) VALUES ('$data->id');";
    }

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