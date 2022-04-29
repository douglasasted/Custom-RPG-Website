<?php
# Connecting to the database, if can't connect than it shows "Conexão falhou: error"
$conn = mysqli_connect("localhost", "root", "", "rpg") or die("Conexão falhou: " . mysqli_connect_error());