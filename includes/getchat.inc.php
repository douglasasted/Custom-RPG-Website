<?php
include_once("dbh.inc.php");

$sql = "SELECT * FROM chat ORDER BY chatId DESC LIMIT 5;";   
$result = mysqli_query($conn, $sql);

$rows = array();

while ($row = $result -> fetch_array()) 
{
    array_push($rows, $row);
}

for ($i = count($rows)-1; $i >= 0; $i--) 
{
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

    if ($i == 0) 
    {
        echo "
            <div style='background-color: white; outline-style: solid; outline-width: 2px; outline-color: lightgrey''><hr><strong style='font-size: 15px;>
                <hr>
                <strong style='font-size: 15px'>", 
                    $rows[$i][1], 
                "</strong> 
                <span class='small'>", 
                    substr($rows[$i][3], 2, -3), 
                "</span>
                <p style ='margin-bottom: 0px; height: 40px; font-size: 14px; font-style: justify; color: ", $color,";'>",
                    $msg,
                "</p>
                <br>
            </div>
        ";
    }
    else
    {
        echo "
            <hr style='margin-bottom: 7px; margin-top: 8px;'>
            <strong style='font-size: 14px'>", 
                $rows[$i][1], 
            "</strong> 
            <span class='small'> ", 
                substr($rows[$i][3], 2, -3), 
            "</span>
            <p style ='margin-bottom: 0px; font-size: 14px; height: 40px; font-style: justify; color: ", $color,";'>",
                $msg,
            "</p>";
    }
}