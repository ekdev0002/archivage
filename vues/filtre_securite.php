<?php
session_start();
 
if (isset($_SESSION['identifiant'])) {
	$url=$_SERVER["REQUEST_URI"];

	$path=str_replace("/archivage/vues/","",$url);
	
	$file=$path;
	
	if (file_exists($file)) {
		
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		
		header("Location: http://127.0.0.1/archivage/"); 
		exit;
	}
	else
	{
		echo $file;
	}
}

 else
 {

	header("Location: http://127.0.0.1/archivage/"); 
	exit;
	}
	
?>