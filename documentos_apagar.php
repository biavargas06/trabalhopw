<?php
    require('twig_carregar.php');
    require('pdo.inc.php'); 

    session_start();
    $id = $_SESSION['iddocumento'];
    $iduser = $_SESSION['idusuario'];  

    $ap = $pdo->prepare('DELETE FROM compartilhar_docs WHERE iddocumento = ?');
    $ap->execute([$id]);
    $sql = $pdo->prepare('DELETE FROM documentos WHERE iddocumento = ?');
    $sql->execute([$id]);

    header("Location: boasvindas.php?idusuario={$_SESSION['idusuario']}");