<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);

include_once('dbh.inc.php');

$id = $data->id;

if($id !== null) 
{
<<<<<<< Updated upstream
    $sql = "DELETE FROM characters WHERE charactersId = '$id'";

    if(mysqli_query($conn, $sql))
        ;
    else
        echo "Erro: Personagem não inserido!";
=======
    $sql = "DELETE FROM items WHERE charactersId = '$id'";

    if(mysqli_query($conn, $sql))
    {
        $sql = "DELETE FROM characters WHERE charactersId = '$id'";
        if(mysqli_query($conn, $sql))
            ;
        else
            echo "Erro: Personagem não removido!";
    }
    else
        echo "Erro: Itens não removidos!";
>>>>>>> Stashed changes
}