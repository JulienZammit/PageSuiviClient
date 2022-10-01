<?php
session_start();
/*
Cette page génère les différentes vues de l'application en utilisant des templates situés dans le répertoire "templates". Un template ou 'gabarit' est un fichier php qui génère une partie de la structure XHTML d'une page. 

La vue à afficher dans la page index est définie par le paramètre "view" qui doit être placé dans la chaîne de requête. En fonction de la valeur de ce paramètre, on doit vérifier que l'on a suffisamment de données pour inclure le template nécessaire, puis on appelle le template à l'aide de la fonction include

Les formulaires de toutes les vues générées enverront leurs données vers la page controleur.php pour traitement. La page controleur.php redirigera alors vers la page index pour réafficher la vue pertinente, généralement la vue dans laquelle se trouvait le formulaire. 
*/

	include_once "libs/maLibUtils.php";
	$view = valider("view");
	if (!$view) $view = "Formulaire";
	include("templates/header.php");

	switch($view)
	{
		case "SuiviProjet" :
			include("templates/SuiviProjet.php");
		break;

		case "Formulaire" :
			include("templates/Formulaire.php");
		break;

		case "Connexionadmin" :
			include("templates/Connexionadmin.php");
			break;

		case "admin" :
			include("templates/admin.php");
			break;
		
		case "modification" :
			include("templates/modification.php");
			break;
			
		case "avissuivi" :
			include("templates/avissuivi.php");
			break;

		default : // si le template correspondant à l'argument existe, on l'affiche
			if (file_exists("templates/$view.php"))
				include("templates/$view.php");
	}
	include("templates/footer.php");
?>








