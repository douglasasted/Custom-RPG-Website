<?php
include_once("dbh.inc.php");

$sql = "SELECT * FROM chat ORDER BY chatId DESC LIMIT 5;";   
$result = mysqli_query($conn, $sql);

$output = array();

while ($row = $result -> fetch_array()) 
{
    echo "<strong>", $row[1], "</strong>:
        <p style ='margin-bottom: 0px;'>",
            $row[2], 
            "<div class='small' style='text-align: right;'>
                ", $row[3] ,"
            </div>
        </p>
        <hr>";
}