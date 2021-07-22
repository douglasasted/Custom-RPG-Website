<?php
$json = file_get_contents('php://input');
$data = json_decode($json);

$id = $data->id;

if($data !== null) 
{
    include_once("dbh.inc.php");

    $valname = $data->valname;
    $value = $data->val;
    $max = $data->max;

    echo $max;

    if ($max == "text") 
    {
        $sql = "UPDATE characters SET " . $valname . " = '" . $value . "' WHERE charactersId = ". $id;
    }
    else if ($max == "ritual") 
    {
        $sql = "UPDATE rituals SET " . $valname . " = '" . $value . "' WHERE ritualsId = ". $id;
    }
    else if ($max == "inventory") 
    {
        $sql = "UPDATE inventory SET " . $valname . " = '" . $value . "' WHERE inventoryId = ". $id;
    }
    else if ($max == "skill") 
    {
        $sql = "UPDATE skills SET " . $valname . " = '" . $value . "' WHERE skillsId = ". $id;
    }
    else if ($max == "gun") 
    {
        $sql = "UPDATE guns SET " . $valname . " = '" . $value . "' WHERE gunsId = ". $id;
    }
    else if ($max == "expertise") 
    {
        $sql = "UPDATE expertises SET expertiseName = '" . $value . "' WHERE expertisesId = ". $id;
    }
    else if ($max == "charExpertise") 
    {
        $sql = "UPDATE expertises SET expertiseValue = " . $value . " WHERE expertisesId = ". $id;
    }
    else if ($max == "check") 
    {
        if ($value == false) $value = 0;
        $sql = "UPDATE expertises SET expertiseCheck = " . $value . " WHERE expertisesId = ". $id;
    }
    else
    {
        $sql = "UPDATE characters SET " . $valname . " = " . $value . " WHERE charactersId = ". $id;
    }
    
    if (mysqli_query($conn, $sql)) 
    {
        ;
    }
    else 
    {
        echo "erro";
    }
}
else 
{
    header("location: ../login.php");
}
