<?php
$id = intval($_GET['id']);
$resID = intval($_GET['resID']);
if (!empty($id)&&!empty($resID)) {
    $file_url = '../public/docsFiles/' . $id . '-'.$resID.'.docx';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: utf-8");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url);
}
else
    echo "Error";
