<?php
    include_once 'header.php';
?>

<div class="row">
    <div class="col-9">
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
                        <div class='display-6 text-center' style='font-size: 25px;'>Fichas de Personagem</div>
                        <div class='row'>";
                    }
                    echo "
                        <div class='col-3'>
                            <br>
                            <div class='text-center' style='margin-bottom: 0px;'>
                                <a href='charactersheet.php?id=" . $row['charactersId'] ."'>" 
                                    . $row['name'] ."
                                </a>
                            </div>
                            <div class='row'>
                                <div class='col-6'>
                                    <strong> Vida </strong> 
                                </div>
                                <div class='col-6'>
                                    9/9
                                </div> 
                                <div class='col-6'>
                                    <strong> Sanidade </strong> 
                                </div>
                                <div class='col-6'>
                                    100/100
                                </div> 
                                <div class='col-6'>
                                    <strong> Dominio </strong> 
                                </div>
                                <div class='col-6'>
                                    15/15
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
    </div>
    <div class="col-3">
        <?php
            include_once 'includes/chat.inc.php';
        ?>
    </div>
</div>

<?php
    include_once 'footer.php';
?>