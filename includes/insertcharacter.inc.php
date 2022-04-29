<?php
session_start();
$json = file_get_contents('php://input');

include_once('dbh.inc.php');

$sql = "INSERT INTO characters (charactersName, charactersPlayer) VALUES ('???', 'douglas_asted');";

<<<<<<< Updated upstream
if(mysqli_query($conn, $sql))
    ;
=======
#for ($i=0; $i < 8; $i++) 
#{ 
#    $sql = $sql . "INSERT INTO items (charactersId) SELECT charactersId FROM characters ORDER BY charactersId DESC LIMIT 1;";
#}

if(mysqli_query($conn, $sql))
{
    for ($i=0; $i < 8; $i++) 
    { 
        $sql = "INSERT INTO items (charactersId) SELECT charactersId FROM characters ORDER BY charactersId DESC LIMIT 1;";
        
        if(mysqli_query($conn, $sql))
        {
            ;
        }
        else
        {
            echo "Erro: Item não inserido!";
            break;
        }
    }
}
>>>>>>> Stashed changes
else
    echo "Erro: Personagem não inserido!";