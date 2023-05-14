<?php
require('models/Model.php');
require('models/Usuario.php');
    $nome=$_POST['nome'] ?? false;
    $pass=$_POST['password'] ?? false;
    $email=$_POST['email'] ?? false;
    

    if (!$nome || !$pass || !$email ){
        header('location:novo_usuario.php');
        die;
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    $usr = new Usuarios();
    $usr->create([
        'nome' => $nome,
        'senha' => $pass,
        'email' => $email,
        


    ]);


    header('location:usuarios.php');
     
 