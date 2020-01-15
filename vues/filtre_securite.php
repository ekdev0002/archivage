<?php
session_start();
 
if (isset($_SESSION['profil'])) {
	$url=$_SERVER["REQUEST_URI"];

	$path=str_replace("/archivage/vues/","",$url);
	
	$pos=strpos($path,'?',0);
	$newpath=substr($path,0,$pos);	
	
	$file=$newpath;	
	
	if (file_exists($file)) {
		
		$dir="temp/";
		if(is_dir($dir)===false){
            mkdir($dir);
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$filetemp=$dir."fichier_a_telecharger.".$ext;
			copy($file, $filetemp);
        }
		else{
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$filetemp=$dir."fichier_a_telecharger.".$ext;
			copy($file, $filetemp);			
		}
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filetemp).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filetemp));
		readfile($filetemp);
		
		//suppression du repertoire temporaire 
		unlink($filetemp);
		rmdir($dir);
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