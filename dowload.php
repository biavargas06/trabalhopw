<?php
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    $uploadsDirectory = __DIR__ . '/uploads/';
    $filepath = $uploadsDirectory . $filename;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "O arquivo não existe.";
    }
} else {
    echo "Nome do arquivo não fornecido.";
}
?>
