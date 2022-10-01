<?php

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=SuiviProjet");
	die("");
}
include_once "libs/maLibForms.php";
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";
?>

<style>
	#corps {
		border: 0px solid white;
		border-radius: 20px;
		padding: 20px;
		width:40%;
		text-align: left;
		margin: 0 auto;
		background-color:white;
		box-shadow: 1px 1px 12px #555;
	}
    body{
        background: #54c4cf;
    }
</style>

<div>
	<div id="corps" style="margin-top: 40px;">

		<h1>Connexion Admin</h1></br>
		<div id="formLogin">
			<?php
			mkForm("controleur.php", "POST");
			echo "Mail : "; mkInput("text","mail","","form-control");
			echo "</br>";
			echo "Mot de Passe : "; mkInput("password","passe","","form-control");
			echo "</br></br>"; mkInput('submit',"action","Connexion","btn","background-color:#325eab; color:white;");
			echo "</br></br>";
			endForm();
			?>
		</div>
	</div>
</div>