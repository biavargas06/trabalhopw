<?php
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Usuario.php');

$nome = $_POST['nome'];
$senha = $_POST['password'];
$id = $_GET['idusuario'];


    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE nome = :usuarios ');
    $sql->bindParam(':usuarios', $nome);
    $sql->execute();

    if ($sql->rowCount()) {
        $usuarios = $sql->fetch(PDO::FETCH_OBJ);

        if (!password_verify($senha, $usuarios->senha)) {
            header('location:login.php?erro=1');
            die;
        }

        session_start();
        $_SESSION['id'] = $usuarios->idusuario;
        $_SESSION['user'] = 'verificado';


        header("location: boasvindas.php?idusuario=$usuarios->idusuario");
        die;
    } else {
        header('location:login.php?erro=1');
        die;
    }