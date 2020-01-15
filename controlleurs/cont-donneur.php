<?php
session_start();
	include('mail/mail_pelba.php');

//if(isset($_SESSION['id_compte'])){

	require_once '../librairies/doctrine/config/global.php';


	if(isset($_POST['enregistrer']) || isset($_POST['modifier'])){
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
	$ps = htmlspecialchars($_POST['poids']);
    $poids= (double)$ps;
		$date_naiss = htmlspecialchars($_POST['date_naiss']);
		$email = htmlspecialchars($_POST['email']);
		$telephone = htmlspecialchars($_POST['telephone']);
		$g_sanguin = htmlspecialchars($_POST['groupe_sanguin']);
		$sexe = htmlspecialchars($_POST['sexe']);
		$id_donneur_potentiel = htmlspecialchars($_POST['type_donneur']);
		//$groupe_sanguin = htmlspecialchars($_POST['groupe_sanguin']);
		$id_donneur_potentiel = htmlspecialchars($_POST['type_donneur']);
		$ville = htmlspecialchars($_POST['ville']);
	$pass1 = htmlspecialchars($_POST['password']);
	$pass2 = htmlspecialchars($_POST['password2']);
	//	$date_naiss = htmlspecialchars($_POST['date_naiss']);
		$profession = htmlspecialchars($_POST['profession']);
		$si_matrimoniale = htmlspecialchars($_POST['si_matrimoniale']);

		//Création d'une variable tableau qui va contenir ls erreurs.
		$erreurs = array();
		//test du mail

		$table_mail = Doctrine_core::getTable('Donneur');
		$mail_existe = $table_mail->findOneByEmail($email);



		if ($pass1 != $pass2) {

			$_SESSION['refus_password'] = 6;
		}

		if($mail_existe){
			//si le mail existe ou pas
			$_SESSION['refus_mail'] = 6;
		}

		if(!empty($erreurs)){

			header('Location: ../index.php?page=inscription');

		}else{


	if(isset($_POST['enregistrer'])){


		//On va créer dans un premier temps le donneur
		//$obj->setTitle('mon titre')   $article->set('title', 'Mon titre');
		$donneur =  new Donneur();
			$donneur->set('date_de_naissance',$date_naiss);
			$donneur->set('poids',$poids);
			$donneur->set('email',$email);
			$donneur->set('telephone',$telephone);
			$donneur->set('profession',$profession);
			$donneur->set('id_donneur_potentiel',$id_donneur_potentiel);
			$donneur->set('id_gpe_sanguin_donneur',$g_sanguin);
			$donneur->set('ville',$ville);
			$donneur->set('si_matrimoniale',$si_matrimoniale);
		$donneur->save();
		$id_donneur = $donneur->id;

		//On insert ensuite dans la table compte.
		$code1 = rand(666, 999666);

		$code =  md5($code1.$email);

		$compte = new Compte();
			$compte->set('login', $email);
			$compte->set('password', $pass1);
			$compte->set('id_type_compte', 1);
			$compte->set('etat', 0);
			$compte->set('code', $code1);

		$compte->save();
		$id_compte = $compte->id;


		$pers = new Personne();
			$pers->set('nom',$nom);
			$pers->set('prenom',$prenom);
			$pers->set('sexe',$sexe);
			$pers->set('photo','defaut.jpg');
			$pers->set('id_donneur',$id_donneur);
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

	}

	if(isset($_POST['modifier'])){
		$id_donneur = $_POST[ 'id_donneur'];

		$table_donneur = Doctrine_core::getTable('Donneur');

		$table_personne = Doctrine_core::getTable('Personne');

		if($mod = $table_donneur->find((int)$id_donneur)){

	    $mod->set('date_de_naissance',$_POST[ '$date_naiss']);
			$mod->set('poids',$_POST['$poids']);
			$mod->set('email',$_POST['$email']);
			$mod->set('telephone',$_POST['$telephone']);
			$mod->set('profession',$_POST['$profession']);
			$mod->set('id_donneur_potentiel',$_POST['$id_donneur_potentiel']);
			$mod->set('id_gpe_sanguin_donneur',$_POST['$g_sanguin']);
			$mod->set('ville',$_POST['$ville']);
			$mod->set('si_matrimoniale',$_POST['$si_matrimoniale']);
		/*	$mod->set('pass1',$_POST['password']);
			$mod->set('pass2 ',$_POST['password2']);*/

		$mod->save();
		/*$ = htmlspecialchars();
		$= htmlspecialchars();*/

		}
		if($mod_personne = $table_personne->findOneById_donneur((int)$id_donneur)){
			$mod_personne->set('nom',$_POST['nom']);
			$mod_personne>set('prenom',$_POST['prenom']);
			$mod_personne->set('sexe',$_POST['sexe']);
		$mod_personne->save();

		}

	}elseif(isset($_GET[md5('id_personne')]) && isset($_GET[md5('supprimer')]) && $_GET[md5('supprimer')] == md5('vrai') ){

		$id_donneur = $_GET[md5('id_personne')];

		$pers =  Doctrine_core::getTable('Personne')->findOneById_donneur((int)$id_donneur);
		$donneur =  Doctrine_core::getTable('Donneur')->find((int)$id_donneur);

		if($pers->delete() && $donneur->delete()){
			header('Location: ../index.php?page=liste-donneur');
		}else{
			echo 'suppression non effectuée';
		}

	}


/*}else{

	header('Location: ../index.php?page=connexion');
}*/

?>
