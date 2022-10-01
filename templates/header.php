<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Page de Suivie - Courant naturel</title>
    <link href="css/sticky-footer.css" rel="stylesheet" />
    <?php

    // Si la page est appelée directement par son adresse, on redirige en passant pas la page index
    if (basename($_SERVER["PHP_SELF"]) != "index.php")
    {
        header("Location:../index.php");
        die("");
    }
    // Pose qq soucis avec certains serveurs...
    echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
    ?>
</head>
<!-- **** F I N **** H E A D **** -->

<!-- **** B O D Y **** -->
<body class="tout">
    
<?php

if($error = valider("error")){
    echo "
	<script type=\"text/javascript\">
window.onload = function() {    Swal.fire({
  icon: 'error',
  title: 'Erreur...',
  text: '$error',
  showConfirmButton: false,
  width: '300px',
  timer: 2000
})}
</script>";
}

if($success = valider("success")){
    echo"
    <script type=\"text/javascript\">
window.onload = function() {    Swal.fire({
  icon: 'success',
  titleText: 'Bravo !',
  text: '$success',
  showConfirmButton: false,
  width: '300px',
  timer: 2000
})}
</script>";
}

if($success = valider("popup1")){
    echo"
    <script type=\"text/javascript\">
window.onload = function() {Swal.fire({
  titleText: 'Légende Documents Client',
  html: '<p><b>Document client</b> : -2-Communiquer Procédure : Nous devons vous envoyer le mail avec les document à nous fournir pour gérer la partie administrative du projet <br>-1-Procédure Communiquée : Nous avons envoyé par mail la liste des documents. En attente des documents du client<br>00-Documents reçus : Documents envoyés par le client et reçu par Courant Naturel => analyse des documents à faire par Courant Naturel<br>0-Incomplet : Documents reçus incomplet => Courant Naturel (Nicole) revient vers le client pour demander les documents manquants<br>1-Complet : Documents reçus complet<br>2-Quasi Complet : Documents reçus incomplet mais ne bloque pas l’initiation du process administratif<br><br><b>Mandat</b>: 1-Rédigé : Mandats rédigés par Courant Naturel. A envoyer au client<br>2-Envoyé au Client : Mandats envoyés par mail au client. En attente des mandats signés retournés par le client<br>3-Retourné par le client : Mandats signés et retournés par mail par le client</p>',
  width: '800px'    
})}
</script>";
}

if($success = valider("popup2")){
    echo"
    <script type=\"text/javascript\">
window.onload = function() {Swal.fire({
  titleText: 'Légende Mairie',
  html: '<p><b>Déclaration Travaux Mairie</b><br>1-Rédigé : DP rédigée<br>2-Envoyé au Client : DP envoyée par mail au client. En attente de retour de DP signée<br>3-Retourné par le client : DP retournée signée<br>3bis - A déposer en Mairie : DP prête à être déposée en Mairie par Courant Naturel<br>4-Déposé en Mairie : DP déposée en Mairie par Courant Naturel (envoi par courrier postal)<br>5-Attente avis BTF : Projet en zone classée. Attente avis des Bâtiments de France<br>6-Avis Négatif BTF => recours  : Projet en zone classée. Avis négatif des ABF => recours lancé par le client<br>7-Avis Négatif BTF => Abandon : Projet en zone classée. Avis négatif des ABF => abandon du projet<br>8-Avis positif BTF => OK : Projet en zone classée. Avis positif des ABF <br>9-récépissé OK : Récépissé de dépôt envoyé par la mairie<br>9b-réclamation mairie : Réclamation de la mairie (documents manquants pour finaliser l’instruction). Courant Naturel doit envoyer les documents manquants<br>10-Retour Mairie = Accord : Avis de non opposition mairie reçu<br>10-Retour Mairie = Délai :  Pas de retour de la mairie et délai d’instruction passé => accord tacite</p>',
  width: '800px' 
})}
</script>";
}

if($success = valider("popup3")){
    echo"
    <script type=\"text/javascript\">
window.onload = function() {Swal.fire({
  titleText: 'Légende Consuel',
  html: '<p><b>Statut consuel</b><br>01 - Formulaire Rédigé : Demande d’attestation Consuel rédigée par Courant Naturel<br>02 - Formulaire Envoyé au Consuel : Demande d’attestation Consuel déposée par Courant Naturel<br>03 - Consuel Validé : Attestation Consuel reçu (pour rappel, le Consuel contrôle les installations par échantillonnage)</p>',
  width: '800px'
})}
</script>";
}

if($success = valider("popup4")){
    echo"
    <script type=\"text/javascript\">
window.onload = function() {Swal.fire({
  titleText: 'Légende Mise en service',
  html: '<p><b>Statut Process Enedis</b><br>0-Démarche non initiée : Process non initiée (la demande de raccordement est initiée une semaine avant la date d installation en général<br>1-Demande Raccordement rédigée : Demande Complète de Raccordement (DCR) rédigée mais pas encore déposée<br>2-Demande Raccordement Envoyé : DCR déposée auprès du gestionnaire du réseau (Enedis, Régie locale)<br>3-Proposition Reçue : Réception de la proposition de raccordement du gestionnaire (devis)<br>4-Proposition Payée : Proposition de raccordement validée et payée par Courant Naturel<br>6-Surplus sans travaux : Retour du gestionnaire d’une mise en service sans travaux (cas des projets en autoconsommation avec vente du surplus)<br>7-Demande de MES réalisée : Demande de mise en service effectuée<br>8-MES Réalisé : Mise en Service effectuée par le gestionnaire</p>',
  width: '800px' 
})}
</script>";
}

if($success = valider("popup5")){
    echo"
    <script type=\"text/javascript\">
window.onload = function() {    Swal.fire({
  titleText: 'Légende Contrat d achat',
  html : '<p><b>Statut process EDF OA</b><br>0-Démarche non initiée : Process non initiée<br>4-Compte EDF OA - Client informé : Client a reçu un mail d’EDF OA demandant la création du compte client sur le portail Edf OA<br>5-Compte EDF OA - Activé : le client a créé son compte sur le portail Edf OA<br>51-Check Infos - KO : Courant Naturel a contrôlé les informations du contrat => erreurs dans le contrat. Réclamation à faire<br>52-Check Infos - OK : Courant Naturel a contrôlé les informations du contrat => tout est OK. Prêt pour signature<br>53-Réclamation : Réclamation portée par Courant Naturel auprès d’EDF OA pour corriger le contrat (si erreur dans le contrat d’achat)<br>6-Contrat - Signé - Prêt à poster : Contrat d achat signé par Courant Naturel. Prêt à être posté<br>7-Contrat - Signé - Envoyé : Contrat d achat signé par Courant Naturel et envoyé à Edf OA (via courrier postal)<br>8-Contrat - Refus EDF OA :  Contrat d achat non co-signé par Edf OA (erreur ou éléments manquants) => à traiter par Courant Naturel<br>9-Contrat - Co Signé EDF OA : Contrat d achat co-signé par Edf OA<br><b>Mail AR </b>: Si OUI = Edf OA a envoyé au client le mail accusé de réception de demande de contrat d achat<br><b>Courrier caracteristique</b> : Si OUI = Edf OA a envoyé au client le courrier avec les caractéristiques du projet<br><b>Mail contrat dispo</b> :  Si OUI = Edf OA a envoyé au client le mail informant que le contrat d achat est disponible sur le portail Edf OA<br></p>',
  width: '800px' 
})}
</script>";
}
?>






