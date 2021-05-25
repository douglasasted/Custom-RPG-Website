<?php
    include_once 'header.php';
?>

<div class="row">
    <div class="col-4">
        Ficha do <a href="charactersheet.php?id=1">José Murilo</a><br>
        Ficha do <a href="charactersheet.php?id=2">Pedro Lopes</a>
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