<?php
session_start();
	include('mail/mail_pelba.php');

//if(isset($_SESSION['id_compte'])){

	require_once '../librairies/doctrine/config/global.php';


	if(isset($_POST['enregistrer']) || isset($_POST['modifier'])){
		$libelle= htmlspecialchars($_POST['libelle']);
		$date_debut = htmlspecialchars($_POST['date_debut']);
     	$date_fin = htmlspecialchars($_POST['date_fin']);




	if(isset($_POST['enregistrer'])){


		//On va créer dans un premier temps le campagne
		$campagne =  new Campagne();
			$campagne->set('libelle',$libelle);
			$campagne->set('date_debut',$date_debut);
			$campagne->set('date_fin',$date_fin);

		$campagne->save();
		$id_campagne = $campagne->id;



		$compte = new Compte();
			$compte->set('login', $email);
			$compte->set('password', $pass1);
			$compte->set('id_type_compte', 1);
			$compte->set('etat', 0);
			$compte->set('code', $code1);

		$compte->save();
		$id_compte = $compte->id;


		$pers = new Acteur();
			$pers->set('nom',$nom);
			$pers->set('prenom',$prenom);
			$pers->set('sexe',$sexe);
			$pers->set('photo','defaut.jpg');
			$pers->set('id_donneur',$id_donneur);
			$pers->set('id_personne_compte',$id_compte);
		$pers->save();



	}

}

	}

	if(isset($_POST['modifier'])){
		$id_acteur = $_POST['id_acteur'];

			echo $id_acteur;

	}elseif(isset($_GET[md5('id_acteur')]) && isset($_GET[md5('supprimer')]) && $_GET[md5('supprimer')] == md5('vrai') ){

		$id_donneur = $_GET[md5('id_acteur')];

		$act=  Doctrine_core::getTable('Acteur')->findOneById_donneur((int)$id_donneur);
		$donneur =  Doctrine_core::getTable('Donneur')->find((int)$id_donneur);

		if($act->delete() && $donneur->delete()){
			header('Location: ../index.php?page=liste-donneur');
		}else{
			echo 'suppression non effectuée';
		}

	}


/*}else{

	header('Location: ../index.php?page=connexion');
}*/

?>
