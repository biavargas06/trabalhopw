<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();
$idD = $_GET['iddocumento'];
$idU = $_GET['idusuario'];

$_SESSION['id'] = $idU;


if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$docs = $pdo->prepare('SELECT * FROM documentos WHERE iddocumento = ?');
$docs->execute([$idD]);
$docs = $docs->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->prepare('SELECT * FROM usuarios WHERE idusuario != ?');
$sql->execute([$idU]);
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('usuarios_compartilhar.html', [
    'users' => $usuarios,
    'iddocumentos' => $docs,
]);