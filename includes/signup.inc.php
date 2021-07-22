<?php
// O usuario entrou no site de forma correta?
if (isset($_POST["submit"])) 
{
    // Variaveis
    $name = $_POST["name"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    // Recebendo conexão e funções
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Abaixo a procura por erros do usuario.
    // Alguma variavel está vazia?
    if (empty($name) || empty($pwd) || empty($pwdRepeat)) 
    {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    // Nome de usuario é invalido?
    if (!preg_match("/^[a-zA-Z0-9_]*$/", $name)) 
    {
        header("location: ../signup.php?error=invalidname");
        exit();
    }

    // A senha é invalida?
    if ($pwd !== $pwdRepeat) 
    {
        header("location: ../signup.php?error=pwddontmatch");
        exit();
    }

    // Nome de usuario ou o email já existe?
    if (nameExist($conn, $name) !== false) 
    {
        header("location: ../signup.php?error=nametaken");
        exit();
    }

    // Caso não houve nenhum erro, crie o usuario
    createUser($conn, $name, $pwd);
}
else
{
    header("location: ../signup.php");
    exit();
}