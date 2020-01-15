<?php



//On recupere ici les données envoyées.

require_once '../librairies/doctrine/config/global.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);


$test = Doctrine_Core::getTable('Compte');

$resust = $test->findOneByLoginAndPassword($username, $password);
/*$resust = $test->findOneByLogin($_POST['username']);*/

if($resust){
	//création de la session de l'utilisateur
session_start();
	$_SESSION['id_compte'] = $resust->id;
	$_SESSION['id_profil_compte'] = $resust->id_profil_compte;
	header('Location: ../index.php?page=accueil-connexion');
	echo 'compte existe';
}else{

	//echo 'compte non existant';
	echo  'compte non exixtant';
    }
?>
