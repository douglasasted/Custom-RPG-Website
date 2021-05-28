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

        <!-- Formulario para Criação de Conta -->
        <div class="signup-form">
            <form action="includes/signup.inc.php" method="post">
                <!-- Titulo -->
                <div class="text-center display-6" style="font-size: 25px;">Crie uma nova conta</div>
                
                <!-- Mostrar um erro na tela caso o usuario tenha cometido um erro -->
                <?php
                    if (isset($_GET["error"])) 
                    {
                        if ($_GET["error"] == "emptyinput") 
                        {
                            echo "<p style='color:red;'>O formulario para criação de conta não foi completado.</p>";
                        }
                        else if ($_GET["error"] == "invalidname") 
                        {
                            echo "<p style='color:red;'>Seu nome de usuario usa caracteres invalidos.</p>";
                        }
                        else if ($_GET["error"] == "invalidemail") 
                        {
                            echo "<p style='color:red;'>Seu email é invalido.</p>";
                        }
                        else if ($_GET["error"] == "pwddontmatch") 
                        {
                            echo "<p style='color:red;'>Senhas não são idênticas.</p>";
                        }
                        else if ($_GET["error"] == "nametaken") 
                        {
                            echo "<p style='color:red;'>Esse nome de usuario ja foi registrado.</p>";
                        }
                        else if ($_GET["error"] == "stmtfailed") 
                        {
                            echo "<p style='color:red;'>Alguma coisa deu errado.</p>";
                        }
                    }
                ?>

                <!-- Formulario -->
                <h6>Nome de usuario</h6>
                <input type="text" size="28" name="name" placeholder="Nome de usuario..."><br><br>
                <h6>Endereço de Email</h6>
                <input type="text" size="28" name="email" placeholder="Email..."><br><br>
                <h6>Senha</h6>
                <input type="password" size="28" name="pwd" placeholder="Senha..."><br><br>
                <h6>Repita sua senha</h6>
                <input type="password" size="28" name="pwdrepeat" placeholder="Repita sua senha..."><br><br>
                
                <!-- Botão de Envio -->
                <h6><button type="submit" name="submit">Criar conta</button></h6><br>

                <!-- Ir para login (caso já tenha conta) -->
                <div class="text-center"><a href="login.php" style="color: rgb(0, 0, 161);">Ja tem uma conta?</a></div>

            </form>
        </div>

        <br>
    </div>
</body>
</html>