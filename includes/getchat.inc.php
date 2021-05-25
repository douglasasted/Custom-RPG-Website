<?php
include_once("dbh.inc.php");

$sql = "SELECT * FROM chat ORDER BY chatId DESC LIMIT 5;";   
$result = mysqli_query($conn, $sql);

while ($row = $result -> fetch_array()) 
{
    $numbers = [];
    preg_match_all('!\d+!', $row[2], $numbers);
    if ($numbers[0][0] === '20') 
        $color = 'green';
    else if ($numbers[0][0] === '1') 
        $color = 'rgb(161, 0, 0)';
    else
        $color = 'black';

    echo "<strong>", $row[1], "</strong>:
        <p style ='margin-bottom: 0px; color: ", $color,";'>",
            $row[2], 
            "<div class='small' style='text-align: right;'>
                ", substr($row[3], 2) ,"
            </div>
        </p>
        <hr>";
}