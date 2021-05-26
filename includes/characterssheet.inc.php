<?php
$json = file_get_contents('php://input');
$data = json_decode($json);

$id = $data->id;

if($data !== null) 
{
    include_once("dbh.inc.php");

    $valname = $data->valname;
    $value = $data->val;

    $sql = "UPDATE characters SET char" . $valname . " = " . $value . " WHERE charactersId = ". $id;
    mysqli_query($conn, $sql);
}
else 
{
    header("location: ../login.php");
}
