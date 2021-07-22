<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);

$id = $data->id;
$type = $data->type;

if($id !== null) 
{
    include_once('dbh.inc.php');

    if ($type == "skill") 
    {
        $sql = "INSERT INTO skills (charactersId) VALUES ('$data->id');";
    }
    else if ($type == "ritual") 
    {
        $sql = "INSERT INTO rituals (charactersId) VALUES ('$data->id');";
    }
    else if ($type == "inventory") 
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
        echo "Erro: Objeto não inserido!";
    }
}