<?php
    session_start();
    
    if (isset($_SESSION["userid"])) 
    {
        header("location: index.php");
    }
?>

<!-- CUSTOM HEADER -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Crie uma nova conta</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <br><br><br><br><br>

    <div class="container" style="max-width: 280px; background-color: white; border-style: outset; border-width:medium; border-color: grey;">
        <br>
        <div class="text-center">< Deslogado ></div>
<!-- CUSTOM HEADER -->

        <!-- Formulario para entrar na conta -->
        <div class="signup-form">
            <form action="includes/login.inc.php" method="post">
                <!-- Titulo -->
                <div class="text-center display-6" style="font-size: 25px;">Entre em sua conta</div>
                
                <?php
                    if (isset($_GET["error"])) 
                    {
                        if ($_GET["error"] == "emptyinput") 
                        {
                            echo "<p style='color:red;'>Nome de usuario ou senha não foram apresentados!</p>";
                        }
                        else if ($_GET["error"] == "wronglogin") 
                        {
                            echo "<p style='color:red;'>Nome de usuario ou senha estão incorretos.</p>";
                        }
                        else if ($_GET["error"] == "none") 
                        {
                            echo "<p style='color:green;'>Sua conta foi criada com sucesso!</p>";
                        }
                    }
                ?>
                
                <!-- Formulario -->
                <h6>Nome de Usuario ou Email</h6>
                <input type="text" size="28" name="name" placeholder="Nome de usuario ou email..."><br><br>
                <h6>Senha</h6>
                <input type="password" size="28" name="pwd" placeholder="Senha..."><br><br>
                
                <!-- Botão de Envio -->
                <h6><button type="submit" name="submit">Entrar</button></h6><br>

                <!-- Ir para login (caso já tenha conta) -->
                <div class="text-center"><a href="signup.php" style="color: rgb(0, 0, 161);">Não tem uma conta?</a></div>

            </form>
        </div>

        <br>
    </div>
</body>
</html>