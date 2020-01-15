<?php
	require_once(dirname(__FILE__).'/../../librairies/PHPMailer/class.phpmailer.php');
	require_once(dirname(__FILE__).'/../../librairies/PHPMailer/class.smtp.php');

	//include("PHPMailer/class.phpmailer.php");
	//include("PHPMailer/class.smtp.php");
	//on crée ici la fonction qui permet denvoyer des email
	function envoyer_email($email_destinataire, $sujet, $body){
		// on débute l'envoi de mail
		$mail = new PHPMailer(true); // Autorisation de l'utilisation du try and cath
		$mail->IsSMTP(); 
		try {
			$mail->Host       = "smtp.gmail.com"; // On fait le lien vers le serveur SMTP                
			$mail->SMTPAuth   = true;                   // on autorise l'utilisation  de smtp 
			$mail->SMTPSecure = "ssl";                 
			$mail->Port       = 465;                   
			$mail->CharSet    = "utf-8";
			$mail->Username   = "bloodprojectgpo@gmail.com ";  // on met l'adresse email qui va envoyer proprement le mail

			$mail->Password   = "gpoconsulting";            // on met le mot de passe de l'adresse qui va envoyer les mails

			$mail->AddAddress($email_destinataire);

			$mail->SetFrom('bloodprojectgpo@gmail.com');

			$mail->AddReplyTo('bloodprojectgpo@gmail.com');
			$mail->Subject = $sujet;
			$mail->AltBody = 'Vous devez diposer d une vue html pour pour visualiser le contenu'; // optional - MsgHTML will create an alternate automatically
			$mail->MsgHTML($body);
			$mail->Send();

			return 'true';
		} 
		catch (phpmailerException $e){
			echo $e->errorMessage();
		}
		catch (Exception $e){
			echo $e->getMessage();
		}  							

	}

?>
		 