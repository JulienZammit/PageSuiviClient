<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php";

	$qs = "";

	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
		switch($action)
		{
			case 'Connexion' :
				if ($mail = valider("mail","POST")) {
					if ($passe = valider("passe","POST")) {
						$nbr = verifUserBdd($mail,$passe);
						if ($nbr==0) {
							$qs = "?view=Connexionadmin&error=" . urlencode("Il faut saisir des identifiants corrects !");
						}else {
							setcookie("mail", $mail, time() + 60 * 60 * 24 * 30);
							setcookie("passe", $passe, time() + 60 * 60 * 24 * 30);
							$qs = "?view=admin&success=". urlencode("Bienvenue dans la page admin");;
						}
					}else{
						$qs = "?view=Connexionadmin&error=" . urlencode("Mot de passe invalide");
					}
				}else{
					$qs = "?view=Connexionadmin&error=" . urlencode("Mail invalide");
				}
				break;

			case 'Suivi' :
			    if($idProjet = valider("idProjet","POST")){
			        $resultat = VerifStatut($idProjet);
			        if($resultat == 1){
						$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&success=". urlencode("Bienvenue dans votre suivi de projet");
			        }else{
						$qs = "?view=Formulaire&error=". urlencode("Ce n'est pas la bonne clé");
			        }
			    }
			break;

			case 'Poster actualité':
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
					if($datepubli = valider("date")){
						if ($titre = valider("titre")) {
							if ($actu = valider("actu")) {
								$date = date('d-m-y h:i:s');
								insertActu($titre, $actu, $date, $datepubli, $mail);
								$qs = "?view=admin" . "&success=" . urlencode("Actualite poste");
							} else {
								$qs = "?view=admin" . "&error=" . urlencode("Ecrivez une actualité");
							}
						}else {
							$qs = "?view=admin" . "&error=" . urlencode("Rentrez un titre");
						}
					} else {
						$qs = "?view=admin" . "&error=" . urlencode("Rentrez une date");
					}
				}
				break;

			case 'Supprimer':
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
					if ($idActu = valider('idActu')) {
						deleteActu($idActu);
						$qs = "?view=admin". "&success=" . urlencode("Actualite supprimee");
					} else {
						$qs = "?view=admin" . "&error=" . urlencode("Pas d'actualite sélectionnee");
					}
				}
				break;
				
			case 'Archiver':
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
					if ($idActu = valider('idActu')) {
						archiveActu($idActu);
						$qs = "?view=admin" . "&success=" . urlencode("Actualite archivee");
					} else {
						$qs = "?view=admin" . "&error=" . urlencode("Pas d'actualité sélectionnée");
					}
				}
				break;
				
			case 'Mettre en ligne':
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
					if ($idActu = valider('idActu')) {
						mettreenligneActu($idActu);
						$qs = "?view=admin" . "&success=" . urlencode("Actualite mise en ligne");
					} else {
						$qs = "?view=admin" . "&error=" . urlencode("Pas d'actualité sélectionnée");
					}
				}
				break;

			case 'Changer':
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
					if ($newmdp = valider('mdp')) {
						if ($confirmation = valider('confirmation')) {
							if ($newmdp === $confirmation) {
								changermdp($passe, $newmdp);
								setcookie("passe", $passe, time() + 60 * 60 * 24 * 30);
								$qs = "?view=Connexionadmin" . "&success=" . urlencode("Mot de passe changé. Reconnectez-vous");
							}else {
								$qs = "?view=admin" . "&error=" . urlencode("Veuillez rentrer le même mot de passe");
							}
						} else {
							$qs = "?view=admin" . "&error=" . urlencode("Rentrez la cofirmation du mot de passe");
						}
					} else {
						$qs = "?view=admin" . "&error=" . urlencode("Rentrez un mot de passe");
					}
				}
				break;

			case "Rechercher":
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
					if($idProjet = valider('idProjet','POST')){
						$resultat = VerifStatut($idProjet);
						if($resultat == 1){
							$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&success=". urlencode("Bienvenue dans le projet d'ID : $idProjet");
						}else{
							$qs = "?view=admin&error=". urlencode("Vous n'avez pas rentré la bonne clé de suivi");
						}
					}
				}
				break;
				
			case "Modifier":
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
				    if ($idActu = valider('idActu')) {
				        $qs = "?view=modification&idActu=" . $idActu;
				    }
				}
				break;
				
			case "Modifier actualité":
				$mail = $_COOKIE['mail'];
				$passe = $_COOKIE['passe'];
				$resultat = verifUserBdd($mail,$passe);
				if($resultat === 0){
					$qs = "?view=Connexionadmin&error=". urlencode("Vous n'etes pas connecte. Vous n'avez pas le droit d'effectuer cette action");
				}else {
				    $idActu = valider('idActu','POST');
				    if($titre = valider('titre','POST')){
				        if($date = valider('date','POST')){
				            if($actu = valider('actu','POST')){
				                updateDate($date, $idActu);
				                updateTitre($titre, $idActu);
				                updateActu($actu, $idActu);
				                $qs = "?view=admin" . "&success=". urlencode("Actualite modifiee");
				            }else{
				                $qs = "?view=modification&idActu=" . $idActu . "&error=". urlencode("Il manque l'actualite");
				            }
				        }else{
				            $qs = "?view=modification&idActu=" . $idActu . "&error=". urlencode("Il manque la date");
				        }
				    }else{
				        $qs = "?view=modification&idActu=" . $idActu . "&error=". urlencode("Il manque le titre");
				    }
				}
				break;
				
				case "Demandez-nous":
				    if($client = valider("client")){
				        $idProjet = valider("idProjet");
				        $qs = "?view=avissuivi&idProjet=" . $idProjet . "&client=" . $client;
				    }else{
				        $qs = "?view=Formulaire	&error=". urlencode("Vous n'avez pas d'id projet à votre nom");
				    }
				    break;
				
				case "Envoyer":
				    $idProjet = valider("idProjet");
				    if($client = valider("client")){
				        if($avis = valider("avis")){
    				        $date = date('d-m-y h:i:s');
    				        insertMessage($client, $date, $avis);
    				        $qs = "?view=SuiviProjet&idProjet=" . $idProjet . " &success=". urlencode("Merci pour votre message !");
				        }else{
				            $qs = "?view=avissuivi&idProjet=" . $idProjet . "&error=". urlencode("Veuillez rentrer un message");
				        }
				    }else{
				        $qs = "?view=avissuivi&idProjet=" . $idProjet . "&error=". urlencode("Vous n'avez pas d'id projet à votre nom");
				    }
				    break;
				
				case "Supprimer message":
				    $idProjet = valider("idProjet");
				    if($idMessage = valider('idMessage')){
				        deleteMessage($idMessage);
				        $qs = "?view=admin&success=". urlencode("Message supprime");
				    }
				    break;
				    
				case "Retour page suivie":
				    if($idProjet = valider('idProjet')){
				        $qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&success=". urlencode("Retour page suivi");
				    }else{
				        $qs = "?view=Formulaire&error" . urlencode("Il manque l id de votre projet"); 
				    }
				    break;
				    
			case "popup1":
				if($idProjet = valider('idProjet')) {
					$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&popup1=1";
				}else{
				   $qs = "?view=Formulaire&error" . urlencode("Il manque l id de votre projet"); 
				}
				break;

			case "popup2":
				if($idProjet = valider('idProjet')) {
					$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&popup2=1";
				}else{
				   $qs = "?view=Formulaire&error" . urlencode("Il manque l id de votre projet"); 
				}
				break;

			case "popup3":
				if($idProjet = valider('idProjet')) {
					$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&popup3=1";
				}else{
				   $qs = "?view=Formulaire&error" . urlencode("Il manque l id de votre projet"); 
				}
				break;

			case "popup4":
				if($idProjet = valider('idProjet')) {
					$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&popup4=1";
				}else{
				   $qs = "?view=Formulaire&error" . urlencode("Il manque l id de votre projet"); 
				}
				break;
				
			case "popup5":
				if($idProjet = valider('idProjet')) {
					$qs = "?view=SuiviProjet&idProjet=" . $idProjet . "&popup5=1";
				}else{
				   $qs = "?view=Formulaire&error" . urlencode("Il manque l id de votre projet"); 
				}
				break;
		}
	}
	$urlBase = "http://localhost/CourantNaturel/index.php";
	header("Location:" . $urlBase . $qs, true, 301);
	//Si le https n'est pas mis sur "ON"
    if(!isset($_SERVER["https"]) || $_SERVER["https"] != "on")
    {
        //Dire au navigateur de rediriger sur HTTPS.
        header("Location:" . $urlBase . $qs, true, 301);
        //Eviter que le reste du script continue de s'excuter.
        exit;
    }
	ob_end_flush();
?>










