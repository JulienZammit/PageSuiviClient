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
<div id="cercle">
    <a href="https://www.courantnaturel.com/" title="Courant Naturel" rel="home" class="logo">
        <img src="https://www.courantnaturel.com/wp-content/uploads/2020/11/logo-2-e1605687964575.png"  class="logo"  alt="Courant Naturel Logo"  />
    </a>
</div>

<div id="corps">
    <?php
    $idProjet = valider('idProjet');
    $nomPrenom = getnom($idProjet);
    ?>
    <h1 class="header">Statut Projet <br> <?php echo $nomPrenom; ?></h1>

    <h1>Informations Générales</h1><br><br>
    <div id="message">
        <?php
        $actu = getActu();
        if (!empty($actu)) {
            foreach ($actu as $i) {
                echo '<h2 id="titre2"> ' . $i['titre'] . "<h4><b> Le " . $i['datepublication'] . "</b></h4>" . '</h2>';
                echo '<p>' . nl2br($i['actu']) . '</p><br><br>';
            }
        } else {
            echo "<p>Aucune Actualité</p>";
        }
        ?>
    </div>

    <br><br><h1>Statut Projet</h1><br><br>
    <br><br><br><br><h2 id='titre2'>INFORMATION PROJET</h2><br><br>
    <div class="formLogin">
        <?php
        $projet = detailprojet($idProjet);
        echo "<p><b>Adresse projet : </b>" ;
        echo $projet[0]['adresseprojet'];
        echo "<br><b>Code postal : </b>" ;
        echo $projet[0]['codepostal'];
        echo "<br><b>Ville : </b>" ;
        echo $projet[0]['ville'];
        echo "<br><b>Date rendez-vous : </b>" ;
        echo $projet[0]['rdv'];
        echo "<br><b>Date retour Devis : </b>" ;
        echo $projet[0]['datedevis'];
        echo "<br><b>Type de contrat : </b>" ;
        echo $projet[0]['TypeContrat'];
        echo "<br> <b>Type d'installation : </b>";
        echo $projet[0]['TypeInstallation'];
        echo "<br> <b>Nombre module : </b>";
        echo $projet[0]['nbrpanneaux'];
        echo "<br> <b>Marque module : </b>";
        echo $projet[0]['marquepanneau'];
        echo "<br> <b>Modèle module : </b>";
        echo $projet[0]['modelepanneau'];
        echo "<br> <b>Spécificité chantier : </b>";
        echo $projet[0]['chantier'];
        echo "<br> <b>Travaux à la charge du client : </b>";
        echo $projet[0]['chargeclient'];
        echo "<br> <b>Date planifiée Début chantier : </b>";
        echo $projet[0]['debut'];
        echo "<br> <b>Date planifiée Fin chantier : </b>";
        echo $projet[0]['fin'];
        echo "<br> <b>Date réalisation installation : </b>";
        echo $projet[0]['daterea'];
        ?>
        </p>
    </div>
    <br><br><h2 id='titre2'>INFORMATION ADMINISTRATION</h2><br>

    <hr>
    <div style="display:flex;justify-content:space-around;">
        <p class="test" style="cursor:pointer;border-bottom:5px solid #325eab;color:#325eab;" onclick="docclient();" id="docclientbis"><strong>Documents Client</strong></p>
        <p class="test" style="cursor:pointer;" onclick="mairie();" id="mairiebis"><strong>Mairie</strong></p>
        <p class="test" style="cursor:pointer;" onclick="Consuel();" id="Consuelbis"><strong>Consuel</strong></p>
        <p class="test" style="cursor:pointer;" onclick="facture();" id="Facturebis"><strong>Facture</strong></p>
        <p class="test" style="cursor:pointer;" onclick="reseau();" id="reseaubis"><strong>Mise en service<br> (ENEDIS, Régie Locale...)</strong></p>
        <p class="test" style="cursor:pointer;" onclick="edfoa();" id="edfoabis"><strong>Contrat d'achat<br> (EDF OA)</strong></p>
    </div>
    <hr>
    <div id='block'>
        <div class='formLogin' id='docclient' style='display:inline-block;'>
            <?php
            $projet = detailadmin($idProjet);
            
            echo "<p><b>Document client : </b>" ;
            echo $projet[0]['docClient'];
            echo "<br><b>Date envoi document au client : </b>" ;
            echo $projet[0]['dateenvoie'];
            echo "<br><b>Date retour document client : </b>" ;
            echo $projet[0]['dateretour'];
            echo "<br><b>Mandat EDF OA : </b>" ;
            echo $projet[0]['mandatedf'];
            echo "<br><b>Mandat Enedis : </b>" ;
            echo $projet[0]['mandatenedis'];
            echo "</p>";
            mkForm("controleur.php");
            mkInput('hidden', 'idProjet', $idProjet);
            mkInput('submit', '', 'Voir Légende',"btn" ,"background-color:#325eab; color:white; width:200px");
            mkInput('hidden', 'action', 'popup1');
            endForm();
            echo "</div>";


            echo "<div class='formLogin' id='mairie' style='display:none;'>";
            echo "<p><b>Déclaration Travaux Mairie : </b>" ;
            echo $projet[0]['travauxmairie'];
            echo "<br> <b>Date envoi dossier Mairie : </b>";
            echo $projet[0]['dateenvoiemairie'];
            echo "<br> <b>Date récepissé Mairie : </b>";
            echo $projet[0]['daterecepissemairie'];
            echo "<br> <b>Numéro de DP : </b>";
            echo $projet[0]['nbrDP'];
            echo "<br> <b>Zone classé bâtiment de France : </b>";
            echo $projet[0]['siteclasse'];
            echo "</p>";
            mkForm("controleur.php");
            mkInput('hidden', 'idProjet', $idProjet);
            mkInput('submit', '', 'Voir Légende',"btn" ,"background-color:#325eab; color:white; width:200px");
            mkInput('hidden', 'action', 'popup2');
            endForm();
            echo "</div>";


            echo "<div class='formLogin' id='Consuel' style='display:none;'>";
            echo "<p><b>Statut consuel : </b>";
            echo $projet[0]['statutconsuel'];
            echo "<br> <b>Date planifiée consuel : </b>";
            echo $projet[0]['dateplanifieconsuel'];
            echo "<br> <b>Date réalisée consuel : </b>";
            echo $projet[0]['daterealiseconsuel'];
            echo "</p>";
            mkForm("controleur.php");
            mkInput('hidden', 'idProjet', $idProjet);
            mkInput('submit', '', 'Voir Légende',"btn" ,"background-color:#325eab; color:white; width:200px");
            mkInput('hidden', 'action', 'popup3');
            endForm();
            echo "</div>";
            ?>
            
            <div class='formLogin1' id='Facture' style='display:none;'>
                <table class="table">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col"><p class='facturetaille'>Numéro facture </p></th>
                        <th scope="col"><p class='facturetaille'>Type facture</p></th>
                        <th scope="col"><p class='facturetaille'>Date envoie </p></th>
                        <th scope="col"><p class='facturetaille'>Date paiement</p></th>
                        <th scope="col"><p class='facturetaille'>Montant</p></th>
                        <th scope="col"><p class='facturetaille'>Montant réglé</p></th>
                        <th scope="col"><p class='facturetaille'>Reste à payer</p></th>
                        <th scope="col"><p class='facturetaille'>Commentaire</p></th>
                        <th scope="col"><p class='facturetaille'>Date relance</p></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $facture = facture($idProjet);
                    if(!empty($facture)) {
                        foreach ($facture as $i) {
                            echo "<tr><td><p class='facturetaille'>" . $i['nuFacture'] . "</p></td>";
                             echo "<td><p class='facturetaille'>" . $i['typeFacture'] . "</p></td>";
                            echo "<td><p class='facturetaille'>" . $i['dateenvoieFacture'] . "</p></td>";
                            echo "<td><p class='facturetaille'>" . $i['datepaiementFacture'] . "</p></td>";
                            if(!empty($i['montantFacture'])) {
                                echo "<td><p class='facturetaille'>" . $i['montantFacture'] . "€</p></td>";
                            }else{
                                echo "<td><p class='facturetaille'>0€</p></td>";
                            }
                            if(!empty($i['montantregleFacture'])) {
                                echo "<td><p class='facturetaille'>" . $i['montantregleFacture'] . "€</p></td>";
                            }else{
                                echo "<td><p class='facturetaille'>0€</p></td>";
                            }
                            if(!empty($i['resteaPayer'])) {
                                echo "<td><p class='facturetaille'>" . $i['resteaPayer'] . "€</p></td>";
                            }else{
                                echo "<td><p class='facturetaille'>0€</p></td>";
                            }
                            echo "<td><p class='facturetaille'>" . $i['commentaire'] . "</p></td>";
                            echo "<td><p class='facturetaille'>" . $i['daterelanceFacture'] . "</p></td></tr>";
                        }
                    }else{
                        echo "<p class='facturetaille'>Aucune facture</p>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            
            <?php

            echo "<div class='formLogin' id='reseau' style='display:none;'>";
            echo "<p><b>Statut Process Enedis : </b>";
            echo $projet[0]['statutprocessenedis'];
            echo "<br> <b>Numéro PDL : </b>";
            echo $projet[0]['nbrPDL'];
            echo "<br> <b>Présence Linky  : </b>";
            echo $projet[0]['linky'];
            echo "<br> <b>Compteur Mono/Tri : </b>";
            echo $projet[0]['compteurmonotri'];
            echo "<br> <b>Numéro DCR : </b>";
            echo $projet[0]['nbrDCR'];
            echo "<br> <b>Date demande de raccordement Enedis : </b>";
            echo $projet[0]['dateraccordementenedis'];
            echo "<br> <b>Date demande MES : </b>";
            echo $projet[0]['demandeMES'];
            echo "<br> <b>Date MES : </b>";
            echo $projet[0]['dateredvMES'];
            echo "</p>";
            mkForm("controleur.php");
            mkInput('hidden', 'idProjet', $idProjet);
            mkInput('submit', '', 'Voir Légende',"btn" ,"background-color:#325eab; color:white; width:200px");
            mkInput('hidden', 'action', 'popup4');
            endForm();
            echo "</div>";


            echo "<div class='formLogin' id='edfoa' style='display:none;'>";
            echo "<p><b>Statut process EDF OA : </b>";
            echo $projet[0]['statutprocessEDFOA'];
            echo "<br> <b>Numéro BTA : </b>";
            echo $projet[0]['nbrBTA'];
            echo "<br> <b>Mail AR : </b>";
            echo $projet[0]['mailAREDFOA'];
            echo "<br> <b>Courrier caracteristique : </b>";
            echo $projet[0]['caractEDFOA'];
            echo "<br> <b>Mail contrat dispo : </b>";
            echo $projet[0]['mailcontratdispoEDFOA'];
            echo "</p>";
            mkForm("controleur.php");
            mkInput('hidden', 'idProjet', $idProjet);
            mkInput('submit', '', 'Voir Légende',"btn" ,"background-color:#325eab; color:white; width:200px");
            mkInput('hidden', 'action', 'popup5');
            endForm();
            echo "</div>";
            ?>
        </div>
    </div>
    
    <!-- 
        <br><br><h1>Facture</h1><br><br>
        <div id="facture">
        <?php
            /*
            $facture = getFacture($idProjet);
            
            */
        ?>
        </div>
    -->
    
    <br><br><h1>Traçabilité des événements</h1><br><br>
    <table class="table">
        <thead class="bg-dark text-light">
        <tr>
            <th scope="col"><p>Date</p></th>
            <th scope="col"><p>Par</p></th>
            <th scope="col"><p>Message</p></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $message = messageSuivi($idProjet);
        $message = array_reverse($message);
        if(!empty($message)) {
            foreach ($message as $i) {
                echo "<tr><td><p>" . $i['Horodatage'] . "</p></td>";
                echo "<td><p>" . $i['EcritPar'] . "</p></td>";
                echo "<td><p>" . $i['Commentaires'] . "</p></td></tr>";
            }
        }else{
            echo "<p>Aucun message de suivi</p>";
        }
        ?>
        </tbody>
    </table>
    
    <div id="footer">
        <p>Lien vers Courantnaturel.com : 
        <a href="https://www.courantnaturel.com/" title="Courant Naturel">
            courantnaturel.com
        </a>
        <br><hr><b>Pour rappel, les informations de cette page de suivi sont mises à jour 2 fois par semaine.</b>
        </p>
    <?php

        mkForm("controleur.php");
            mkInput('hidden', 'client', $nomPrenom);
            mkInput('hidden', 'idProjet', $idProjet);
            echo "<b>Un avis, une question ? </b>";
            mkInput('submit', 'action', 'Demandez-nous',"btn" ,"background-color:#325eab; color:white; width:200px");
        endForm();

    ?>
    </div>
        
        <!--
        <br><br><h2 id="titre2">Vos documents</h2><br><br>
            <div id="iframe">
                <div onload="load_iframe(<?php //echo $nomPrenom?>/signature.pdf);"></div>
                <div onload="load_iframe(<?php //echo $nomPrenom?>/contratenedis.pdf);"></div>
                <div onload="load_iframe(<?php //echo $nomPrenom?>/contratedf.pdf);"></div>
                <div onload="load_iframe(<?php //echo $nomPrenom?>/contratmairie.pdf);"></div>
            </div>
    </script> -->
    
</div>

<div class="modal fade" id="popupabos" tabindex="-1" aria-labelledby="popupabos" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>


