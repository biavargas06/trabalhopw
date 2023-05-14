<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();

$idD = $_GET['iddocumento'];
$idU = $_GET['idusuario'];
$perm = $_POST['select'];

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('INSERT INTO `compartilhar_docs` (`idcompartilhar_docs`, `permissao`, `iddocumento`, `usuarios_idusuario`) 
VALUES (NULL, :perm, :idD, :idU)');
$sql->BindParam(':perm',$perm);
$sql->BindParam(':idD',$idD);
$sql->BindParam(':idU',$idU);
$sql->execute();


header("Location: boasvindas.php?idusuario={$_SESSION['id']}");