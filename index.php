<?php
    include_once 'header.php';
?>

<?php 
    include_once 'includes/dbh.inc.php';

    $sql = "SELECT * FROM characters";
    $result = mysqli_query($conn, $sql);

    $n = 0;

    while ($row = $result -> fetch_array()) 
    {
        if ($row['player'] === $_SESSION['username'] || $_SESSION['username'] === "Douglas_Asted") 
        {
            if ($n == 0) 
            {
                echo "
                <br>
                <div class='display-6 text-center' style='font-size: 25px;'>Fichas de Personagem</div>
                <div class='row'>";
            }
            echo "
                <div class='col-3'>
                    <br>
                    <div class='text-center' style='margin-bottom: 0px;'>
                        <a href='charactersheet.php?id=" . $row['charactersId'] ."'>("
                            . $row['level'] . ") "
                            . $row['name'] ."
                        </a>
                    </div>
                    <div class='row'>
                        <div class='col-6'>
                            <strong> Vida </strong> 
                        </div>
                        <div class='col-6'>
                            " . $row['currentLife'] . " / " . $row['maxLife'] . "
                        </div> 
                        <div class='col-6'>
                            <strong> Sanidade </strong> 
                        </div>
                        <div class='col-6'>
                        " . $row['currentSanity'] . " / " . $row['maxSanity'] . "
                        </div>
                    </div>
                </div>
            ";
            $n += 1;
        }
    }

    if ($n !== 0) 
    {
        echo "</div>";
    }
?>

<?php
    include_once 'footer.php';
?>