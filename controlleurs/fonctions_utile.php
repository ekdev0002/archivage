<?php

//require_once '../librairies/doctrine/config/global.php';

//  Fonction qui va nous renvoyer le groupe sanguin
function gpe_sanguin($donneur){
	$don = Doctrine_core::getTable('Groupe_sanguin')->find((int)$donneur);

	$gp = $don->libelle;
	$res = $don->rhesus;
	return $gp.' '.$res;
}
// Fonction qui va nous renvoyer le type de donneurr

	function type_donneur($donneur){
	$tp = Doctrine_core::getTable('Donneur_potentiel')->find((int)$donneur);

	$ans = $tp->libelle;
	return $ans;
}

// Fonction renvoyer l'id du groupe sanguin en fonction du donneur.*/
function id_gpe_sanguin($donneur){
	$don = Doctrine_core::getTable('Groupe_sanguin')->find((int)$donneur);

	$gp = $don->id;
	return $gp;

}


	// Fonction qui  renvoye l'id du type de donneur connaissant le donneur.
function id_donneur_potentiel($donneur){
	$tp = Doctrine_core::getTable('Donneur_potentiel')->find((int)$donneur);

	$answ = $tp->id;
	return $answ;
}

//fonction qui genere arbitrairement les codes des utilisateurs.
    function generer_code($taille){
        $ALPHABET = 'ABCDEFGHIJKLMNOPQRSTazertyuiopqsdfghjklmwxcvbn0123456789';
        $code = '';
        $trouver = true;
            for($i = 0; $i < $taille; $i++){
                $code .= rand(0, 1) == 0 ? strtolower($ALPHABET[rand()%strlen($ALPHABET)]) : strtoupper($ALPHABET[rand()%strlen($ALPHABET)]);
            }

        return $code;
    }

    // Fonction qui  recupere les info de l'infirmier 

    function info_infirmier($id){
    	$inf = Doctrine_core::getTable('Personne')->findOneById_infirmier($id);
    	return $inf;
    }
 ?>
