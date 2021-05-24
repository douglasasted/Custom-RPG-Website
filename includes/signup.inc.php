<?php
// O usuario entrou no site de forma correta?
if (isset($_POST["submit"])) 
{
    // Variaveis
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    // Recebendo conexão e funções
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Abaixo a procura por erros do usuario.
    // Alguma variavel está vazia?
    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat)) 
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

    // O email é invalido?
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    // A senha é invalida?
    if ($pwd !== $pwdRepeat) 
    {
        header("location: ../signup.php?error=pwddontmatch");
        exit();
    }

    // Nome de usuario ou o email já existe?
    if (nameExist($conn, $name, $email) !== false) 
    {
        header("location: ../signup.php?error=nametaken");
        exit();
    }

    // Caso não houve nenhum erro, crie o usuario
    createUser($conn, $name, $email, $pwd);
}
else
{
    header("location: ../signup.php");
    exit();
}