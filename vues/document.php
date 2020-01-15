<?php
session_start();
if(!isset($_SESSION['profil'])){
    header("location: ../index.php");
}
?>
<?php
//include_once("entete.php");
include_once("menu.php");

?>


<?php
$url=($_GET['doc']);
$document = Doctrine_core::getTable('Archive')->find($url);
$full_path='dossier/'.$document->fichier;
$file_name = basename($full_path);

/*header('Content-disposition: attachment; filename="' . basename($file) . '"');
header('Content-Type: image/png');
header('Content-Transfert-Encoding: application/octet-stream');


readfile($file);
//header('X-Sendfile: ' . $file);
exit;*/
//echo $document->fichier;


ini_set('zlib.output_compression', 0);
$date = gmdate(DATE_RFC1123);

header('Pragma: public');
header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');

header('Content-Tranfer-Encoding: none');
header('Content-Length: '.filesize($full_path));
header('Content-MD5: '.base64_encode(md5_file($full_path)));
header('Content-Type: application/octetstream; name="'.$file_name.'"');
header('Content-Disposition: attachment; filename="'.$file_name.'"');

header('Date: '.$date);
header('Expires: '.gmdate(DATE_RFC1123, time()+1));
header('Last-Modified: '.gmdate(DATE_RFC1123, filemtime($full_path)));

readfile($full_path);
exit;

?>