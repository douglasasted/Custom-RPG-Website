<?php
    include_once 'header.php';
?>

<div class="row">
    <div class="col-4">
        <?php 
            include_once 'includes/dbh.inc.php';

            $sql = "SELECT * FROM characters";
            $result = mysqli_query($conn, $sql);
            
            while ($row = $result -> fetch_array()) 
            {
                if ($row['charactersPlayer'] === $_SESSION['username'] || $_SESSION['username'] === "Douglas_Asted") 
                {
                    echo "Ficha do <a href='charactersheet.php?id=" . $row['charactersId'] ."'>" . $row['charactersName'] ."</a><br>";
                }
            }
        ?>
    </div>
    <div class="col-5">
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