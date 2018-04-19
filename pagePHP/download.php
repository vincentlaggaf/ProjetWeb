<?php
$dir = '../imagePNG/events';
$zip = new ZipArchive;
$filename = "./images_site_BDE.zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("Impossible d'ouvrir le fichier <$filename>\n");
}
else{
    $fileDir = array_diff(scandir($dir), array('..', '.'));
    foreach($fileDir as $file)
    {
        $zip->addFile($dir."/".$file, $file);
    }
    $zip->close();
    if (file_exists($filename)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
    }
    unlink($filename);
}
exit;
?>
