<?php
include_once("dbh.inc.php");

$sql = "SELECT * FROM chat ORDER BY chatId DESC LIMIT 50;";   
$result = mysqli_query($conn, $sql);

$rows = array();

while ($row = $result -> fetch_array()) 
{
    array_push($rows, $row);
}

$msg = "";

for ($i = count($rows)-1; $i >= 0; $i--) 
{
    $msg = $msg . substr($rows[$i][2], 3) . '\n';
    $sub = substr($rows[$i][2], 0, 3);
    $msg = substr($rows[$i][2], 3);
    
    $numbers = [];
    preg_match_all('!\d+!', $rows[$i][2], $numbers);

    if ($sub === "EXP")
        $color = 'black';
    else
    {
        if ($numbers[0][0] === '20') 
            $color = 'green';
        else if ($numbers[0][0] === '1') 
            $color = 'rgb(161, 0, 0)';
        else
            $color = 'black';
    }

    echo " 
        <div>
            <strong style='font-size: 12px'>", 
                $rows[$i][1], 
            "</strong> 
            <span class='small'> ", 
                substr($rows[$i][3], 2, -3), 
            "</span>
            <p style ='margin-bottom: 0px; font-size: 12px; height: 40px; font-style: justify; color: ", $color,";'>",
                $msg,
            "</p>
        </div>";
}