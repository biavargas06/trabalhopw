    <?php
    require('twig_carregar.php');
    require('pdo.inc.php');
    require('models/Model.php');
    require('models/Documento.php');
    require('func/sanitize_filename.php');
    require('func/verifica_nome_arquivo.php');

    date_default_timezone_set('America/Sao_Paulo');

    $id = $_GET['idusuario'];

    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $allowedMimeTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']) {
        $fileExtension = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        $fileMimeType = $_FILES['arquivo']['type'];

        if (!in_array(strtolower($fileExtension), $allowedExtensions) || !in_array($fileMimeType, $allowedMimeTypes)) {
            $errorMessage = 'APENAS OS FORMATOS PDF, DOC E DOCX SERÃO ACEITOS!!';
            $errorStyle = 'background-color: #FFABAB; color: #F400A1; font-weight: bold; font-size: 16px; text-align: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);';    
            $errorMessageHTML = '<p style="'.$errorStyle.'">'.$errorMessage.'</p>';
            die($errorMessageHTML);
        }


        $arquivo = sanitize_filename($_FILES['arquivo']['name']);
        $arquivo = verifica_nome_arquivo('uploads/', $arquivo);

        move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);

        $doc = new Documentos();

        $doc->create([
            'iddocumento' => null,
            'nome' => $arquivo,
            'usuarios_idusuario' => $id,
            'data_upload' => date('Y-m-d'), 
        ]);
    }

    echo $twig->render('documentos_novo.html', [
        'iduser' => $id,
    ]);
