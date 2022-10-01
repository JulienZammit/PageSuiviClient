<?php

if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=SuiviProjet");
	die("");
}
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";
include_once "libs/maLibForms.php";
$idProjet = valider("idProjet");
mkForm("controleur.php");
    mkInput("hidden","idProjet",$idProjet);
    echo "Retour page suivie : "; mkInput('submit', "action", "Retour page suivie","btn" ,"background-color:#325eab; color:white; width:200px");
endForm();
?>

<?php
$client = valider("client");

echo '<h1>Donnez-nous votre avis</h1></br>';
        mkForm("controleur.php", "POST");
            echo "<textarea name='avis' id='actu' class='form-control me-2'></textarea>";
            echo "</br>";
            mkInput("hidden","client",$client);
            mkInput("hidden","idProjet",$idProjet);
            mkInput('submit', "action", "Envoyer","btn" ,"background-color:#325eab; color:white; width:200px");
        endForm();
?>
        