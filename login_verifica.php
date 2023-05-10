<?php
    require('pdo.inc.php');

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = :usr AND ativo = 1');

    $sql->bindParam(':usr', $user);

    $sql->execute();

    if ($sql->rowCount()) {
    
        $user = $sql->fetch(PDO::FETCH_OBJ);

        if (!password_verify($pass, $user->senha)) {
         
            header('location:login.php?erro=1');
            die;
        }

        session_start();
        $_SESSION['user'] = $user->nome;
       
        header('location:boasvindas.php');
        die;
    } else {
     
        header('location:login.php?erro=1');
        die;
    }