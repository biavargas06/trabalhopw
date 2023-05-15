<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();

$id = $_GET['idusuario'];

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('SELECT compartilhar_docs.*, documentos.nome, documentos.usuarios_idusuario 
AS d_iduser, usuarios.nome AS usuario_nome 
FROM compartilhar_docs JOIN documentos ON documentos.iddocumento = compartilhar_docs.iddocumento
JOIN usuarios ON documentos.usuarios_idusuario = usuarios.idusuario
WHERE compartilhar_docs.usuarios_idusuario = ?');
$sql->execute([$id]);

$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('lista.html', [
    'usuarios' => $usuarios,
    'idusuario' => $id,
]);