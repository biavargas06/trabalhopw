<?php
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Usuario.php');
session_start();

$user = null;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['idusuario'] ?? false;
    if ($id) {
        $sql = $pdo->prepare('SELECT * FROM usuarios WHERE idusuario = ?');
        $sql->execute([$id]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

if (!$user) {
    die("Usuario não encontrado");
}

if (isset($_SESSION['id']) && $_SESSION['id'] != $user['idusuario']) {
    session_destroy();
    header("location:login.php");
}

echo $twig->render('boasvindas.html', [
    'usuarios' => $user,
]);