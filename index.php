<?php
    include_once 'header.php';
?>

<br>
<div class='display-6 text-center' style='font-size: 25px;'> 
    <?php 
    if ($_SESSION['username'] === "douglas_asted") 
        echo '<input onclick=\'newCharacter()\' type=\'image\' src=\'imgs/add.png\' style="display: inline-block" width=\'22\' height=\'22\'/>'; 
    ?>  Personagens
</div>
<div class='row'>

<?php 
    include_once 'includes/dbh.inc.php';

    $sql = "SELECT * FROM characters";
    $result = mysqli_query($conn, $sql);

    $n = 0;
    $characters = array();
    $monsters = array();

    while ($row = $result -> fetch_array()) 
    {
        if ($row['charactersPlayer'] == 'douglas_asted' && $_SESSION['username'] === "douglas_asted")
            array_push($characters, $row);
        else if ($row['charactersPlayer'] == 'monster' && $_SESSION['username'] === "douglas_asted")
            array_push($monsters, $row);
        else if ($row['charactersPlayer'] === $_SESSION['username'] || $_SESSION['username'] === "douglas_asted") 
        {
            echo "
                <div class='col-3'>
                    <br>
                    <div class='text-center' style='margin-bottom: 0px; margin-right: 40px'>
                        <a href='charactersheet.php?id=" . $row['charactersId'] ."'>("
                            . $row['charactersLevel'] . ") "
                            . $row['charactersName'] ."
                        </a>
                    </div>
                    <div class='row'>
                        <div class='col-6'>
                            <strong> Vida </strong> 
                        </div>
                        <div class='col-6'>
                            " . $row['charactersHealth'] . " / " . $row['charactersMaxHealth'] . "
                        </div> 
                        <div class='col-6'>
                            <strong> Sanidade </strong> 
                        </div>
                        <div class='col-6'>
                        " . $row['charactersSanity'] . " / " . $row['charactersMaxSanity'] . "
                        </div>
                    </div>
                </div>
            ";
            #  <div class='col-6'>
            #      <strong> Dominio </strong> 
            #  </div>
            #  <div class='col-6'>
            #      " . $row['charactersDomain'] . " / " . $row['charactersMaxDomain'] . "
            #  </div>
            $n += 1;
        }
    }

    if ($n !== 0) 
        echo "</div>";
?>

<?php

    $n = 0;

    foreach ($characters as $row) 
    {
        if ($n == 0) 
            echo "<br><br><br><br><br><div class='row'>";
        
        echo "
        <div class='col-3'>
            <br>
            <div class='text-center' style='margin-bottom: 0px; margin-right: 40px'>
                <a href='charactersheet.php?id=" . $row['charactersId'] ."'>("
                    . $row['charactersLevel'] . ") "
                    . $row['charactersName'] ."
                </a>
            </div>
            <div class='row'>
                <div class='col-6'>
                    <strong> Vida </strong> 
                </div>
                <div class='col-6'>
                    " . $row['charactersHealth'] . " / " . $row['charactersMaxHealth'] . "
                </div> 
                <div class='col-6'>
                    <strong> Sanidade </strong> 
                </div>
                <div class='col-6'>
                " . $row['charactersSanity'] . " / " . $row['charactersMaxSanity'] . "
                </div>
            </div>
        </div>
        ";
      #  <div class='col-6'>
      #      <strong> Dominio </strong> 
      #  </div>
      #  <div class='col-6'>
      #      " . $row['charactersDomain'] . " / " . $row['charactersMaxDomain'] . "
      #  </div>
        $n += 1;
    }

    if ($n !== 0) 
        echo "</div>";
    
    $n = 0;

    foreach ($monsters as $row) 
    {
        if ($n == 0) 
        {
            echo "
            <br>
            <div class='display-6 text-center' style='font-size: 25px;'>Fichas de Monstros</div>
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
                </div>
            </div>
        ";
        $n += 1;
    }

    if ($n !== 0) 
        echo "</div>";
?>
</div>

<script src="javascript/index.js"></script>
<?php
    include_once 'footer.php';
?>