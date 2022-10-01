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
Retour Connexion : <a href="http://courantnaturel.fr/index.php?view=Connexionadmin"><button class="btn" style="background-color:#325eab; color:white; width:200px">Connexion</button></a>
<?php   
        echo '<h1>Poster une Actualité</h1></br>';
        mkForm("controleur.php", "POST");
        echo "Ajouter un titre : ";
        mkInput("text", "titre", "","form-control me-2");
        echo "</br></br>Ajouter une date de publication : ";
        mkInput("date", "date", "");
        echo "</br></br>";
        echo "Ajouter une actualité : ";
        echo '<textarea name="actu" id="actu" class="form-control me-2" "></textarea>';
        echo "</br></br>";
        mkInput('submit', "action", "Poster actualité","btn" ,"background-color:#325eab; color:white; width:200px");

        echo '<h1>Recherche projet</h1></br>';
        echo 'Rechercher un client par son idProjet : <br><br>'; mkInput("search","idProjet","","form-control me-2");
        echo '<br>'; mkInput("submit","action","Rechercher","btn" ,"background-color:#325eab; color:white; width:200px");

        $passe = $_COOKIE['passe'];
        echo '<h1>Changer de mot de passe</h1></br>';
        echo "Entrez votre nouveau mot de passe : ";
            mkInput("text", "mdp", "","form-control me-2");
        echo "</br></br>";
        echo "Confirmation de votre mot de passe : ";
            mkInput("text", "confirmation", "","form-control me-2");
            mkInput("hidden", "pass", $passe);
        echo "</br></br>";
            mkInput('submit', "action", "Changer","btn" ,"background-color:#325eab; color:white; width:200px");
        endForm();

        echo '<div id=nonarchive>';
        echo '<h1>Gérer les actualités</h1></br>
              <table class="table">
              <h2 id="titre2" style="margin-top:120px;">Acualité non archivée</h2>
              <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Actualité</th>
                        <th scope="col">Horodatage</th>
                        <th scope="col">Par</th>
                        <th scope="col">Date Publication</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
              </thead>
              <tbody>';
        $actu = getActu();
        if (!empty($actu)) {
            $mail = $_COOKIE['mail'];
            foreach ($actu as $i) {
                mkForm("controleur.php","POST");
                echo "<tr><td>" . $i['titre'] . "</td>";
                echo "<td>" . $i['actu'] . "</td>";
                echo "<td>" . $i['time'] . "</td>";
                echo "<td>" . $i['emailAdmin'] . "</td>";
                echo "<td>" . $i['datepublication'] . "</td>";
                echo "<td>";
                mkInput("submit", "action" ,"Archiver","btn" ,"background-color:#325eab; color:white; width:100px");
                echo "</td>";
                echo "<td>";
                mkInput("submit", "action" ,"Modifier","btn" ,"background-color:#325eab; color:white; width:100px");
                echo "</td></tr>";
                mkInput("hidden","idActu",$i["idActu"]);
                endForm();
            }
        }else echo'Aucune actualité';
        echo '</tbody>';
        echo '</div>';
        
        echo '<div id=archive>';
        echo '<table class="table">
                <h2 id="titre2">Actualité archivée</h2>
              <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Actualité</th>
                        <th scope="col">Horodatage</th>
                        <th scope="col">Par</th>
                        <th scope="col">Date Publication</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
              </thead>
              <tbody>';
        $actu = getActuarchive();
        if (!empty($actu)) {
            $mail = $_COOKIE['mail'];
            foreach ($actu as $i) {
                mkForm("controleur.php","POST");
                echo "<tr><td>" . $i['titre'] . "</td>";
                echo "<td>" . $i['actu'] . "</td>";
                echo "<td>" . $i['time'] . "</td>";
                echo "<td>" . $i['emailAdmin'] . "</td>";
                echo "<td>" . $i['datepublication'] . "</td>";
                echo "<td>";
                mkInput("submit", "action" ,"Supprimer","btn" ,"background-color:#325eab; color:white; width:100px");
                echo "</td>";
                echo "<td>";
                mkInput("submit", "action" ,"Modifier","btn" ,"background-color:#325eab; color:white; width:100px");
                echo "</td>";
                echo "<td>";
                mkInput("submit", "action" ,"Mettre en ligne","btn" ,"background-color:#325eab; color:white; width:150px");
                echo "</td></tr>";
                mkInput("hidden","idActu",$i["idActu"]);
                endForm();
            }
        }else echo'Aucune actualité archivée';
        echo '</tbody>';
        echo '</div></table>';
        
        echo '<h1>Retour page administration client</h1></br>
              <table class="table">
              <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Horodatage</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
              </thead>
              <tbody>';
        $message = getMessage();
        if (!empty($message)) {
            foreach ($message as $i) {
                $nomClient = $i['nomprenom'];
                $idProjet = getidProjet($nomClient);
                mkForm("controleur.php","POST");
                echo "<tr><td>" . $i['nomprenom'] . "</td>";
                echo "<td>" . $i['horodatage'] . "</td>";
                echo "<td>" . $i['message'] . "</td>";
                echo "<td><a href='https://suivi.courantnaturel.com/index.php?view=SuiviProjet&idProjet=" . $idProjet . "'>Statut du client</a></td>";
                echo "<td>";
                mkInput("hidden","idMessage",$i['idMessage']);
                mkInput("submit", "action" ,"Supprimer message","btn" ,"background-color:#325eab; color:white; width:200px");
                $email = getemail($idProjet);
                echo "</td>";
                echo "<td><a href='mailto:" . $email . "'><div id='email'>Envoyer un mail</div></a></td>";
                endForm();
            }
        }else echo'Aucun message';
        echo '</tbody></table>';
?>
</div>

