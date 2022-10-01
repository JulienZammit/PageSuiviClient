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
?>

Retour page Admin : <a href="http://courantnaturel.fr/index.php?view=admin"><button class="btn" style="background-color:#325eab; color:white; width:200px">Page Admin</button></a>

<?php
$idActu = valider("idActu");
$actu = getActu2($idActu);
echo '<h1>Modifier une Actualité</h1></br>';
        mkForm("controleur.php", "POST");
            echo "Ajouter un titre : ";
            mkInput("text", "titre",$actu[0]['titre'],'form-control me-2');
            echo "</br></br>Ajouter une date de publication : ";
            mkInput("date", "date", $actu[0]['datepublication']);
            echo "</br></br>";
            echo "Ajouter une actualité : ";
            echo "<textarea name='actu' id='actu' class='form-control me-2'>" . $actu[0]['actu'] . "</textarea>";
            echo "</br></br>";
            mkInput("hidden","idActu",$idActu);
            mkInput('submit', "action", "Modifier actualité","btn" ,"background-color:#325eab; color:white; width:200px");
        endForm();
?>
        