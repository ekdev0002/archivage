<?php
session_start();
	include('mail/mail_pelba.php');

	include('fonctions_utile.php');

//if(isset($_SESSION['id_compte'])){

	require_once '../librairies/doctrine/config/global.php';


	if(isset($_POST['enregistrer']) || isset($_POST['modifier'])){
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);

		$sexe = htmlspecialchars($_POST['sexe']);
		$grade = htmlspecialchars($_POST['grade']);
		$email = htmlspecialchars($_POST['email']);


	if(isset($_POST['enregistrer'])){


		//On va créer dans un premier temps le campagne il ny a q grade ds infirmier
		$infirmier =  new Infirmier();
		$infirmier->set('grade',$grade);
		$infirmier->save();
		$id_infirmier = $infirmier->id;


		$code1 = rand(666, 999666);

		$code =  md5($code1.$email);

		//On genere un mot de passe provisior pour l'infirmier en cours de création.
		$pass_gener = generer_code(4);

		$compte = new Compte();
			$compte->set('login', $email);
			$compte->set('password', $pass_gener);
			$compte->set('id_profil_compte', 3);
			$compte->set('etat', 0);
			$compte->set('code', $code1);

		$compte->save();
		$id_compte = $compte->id;


		$pers = new Personne();
			$pers->set('nom',$nom);
			$pers->set('prenom',$prenom);
			$pers->set('sexe',$sexe);
			$pers->set('photo','defaut.jpg');
			$pers->set('id_infirmier',$id_infirmier);
			$pers->set('id_personne_compte',$id_compte);
		$pers->save();



	$destinataire=$email;
	$email_destinataire = $email;
	$sujet='salut';
	$message='<strong>Bienvenu Chez GPO Consulting! Afin d\'activer votre compte veuillez suivre le lien suivant: <a href="127.0.0.1/blood_project/accueil-connexion.php&&code=<?=$code?>&&liam=<?=$email?>"> lien</a></strong>';


	if(envoyer_email($email_destinataire, $sujet, $message) == 'true')

		//$_SESSION['nouveau_compte'] = 4;
		//header('Location: index.php?page=inscription');

		echo 'mail envoyé';


	}

}



	if(isset($_POST['modifier'])){
		$id_infirmier = $_POST['id_infirmier'];

		$table_inf = Doctrine_core::getTable('Infirmier');

		$table_per = Doctrine_core::getTable('Acteur');

		if($mod = $table_inf->find((int)$id_infirmier)){
			$mod->set('grade',$_POST['grade']);
		$mod->save();
		}
		if($mod_per = $table_per->findOneById_infirmier((int)$id_infirmier)){
			$mod_per->set('nom',$_POST['nom']);
			$mod_per->set('prenom',$_POST['prenom']);
			$mod_per->set('sexe',$_POST['sexe']);
		$mod_per->save();

		}
		$aff=   "<div class='alert alert-success' style='margin-top:10px'>"
						. "<p>Modification effectuée avec succès</p>"
						. "</div>";
echo   $aff;


	}elseif(isset($_GET[md5('id_acteur')]) && isset($_GET[md5('supprimer')]) && $_GET[md5('supprimer')] == md5('vrai') ){

		$id_infirmier = $_GET[md5('id_acteur')];

		$pers =  Doctrine_core::getTable('Acteur')->findOneById_infirmier((int)$id_infirmier);
		$infirmier =  Doctrine_core::getTable('Infirmier')->find((int)$id_infirmier);

		if($pers->delete() && $infirmier->delete()){
			header('Location: ../index.php?page=liste-infirmier');
		}else{
			echo 'suppression non effectuée';
		}

	}


/*}else{

	header('Location: ../index.php?page=connexion');
}*/

?>
