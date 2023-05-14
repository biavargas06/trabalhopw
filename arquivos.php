<?php
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Documento.php');

$id = $_GET['idusuario'];

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('SELECT * FROM documentos WHERE documentos.usuarios_idusuarios = ?');
$sql->execute([$id]);
$documentos = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('arquivos.html', [
    'documentos' => $documentos,
]);