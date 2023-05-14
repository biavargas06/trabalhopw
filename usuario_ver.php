<?php
    require('verifica_login.php');
    require('twig_carregar.php');
    
    require('models/Model.php');
    require('models/Usuario.php');

    $id = $_GET['id'] ?? false;

    $usr = new Usuarios();
    $info = $usr->getById($id);

    echo $twig->render('usuario_ver.html', [
        'usuario' => $info,
    ]);