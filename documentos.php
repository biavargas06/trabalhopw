<?php
require('twig_carregar.php');
require('pdo.inc.php');

$id = $_GET['idusuario'];
echo $twig->render('documentos.html',[
'id' => $id,
]);