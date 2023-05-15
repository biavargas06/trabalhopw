<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();
$id = $_GET['iddocumento'];
$iduser = $_GET['idusuario'];
$_SESSION['idusuario'] = $iduser;
$_SESSION['iddocumento'] = $id;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}


echo $twig->render('documentos_apagar.html', [
    'idusuario' => $iduser,
]);