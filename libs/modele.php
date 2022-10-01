<?php
include_once("maLibSQL.pdo.php");

function verifUserBdd($login,$password){
	$login = htmlspecialchars($login);
	$password = htmlspecialchars($password);
	$SQL = "SELECT COUNT(mail) FROM administration WHERE mail='$login' AND password='$password'";
	$nbr=SQLGetChamp($SQL);
	if($nbr==0){
		return 0;
	}else{
		return 1;
	}
}

function VerifStatut($idProjet){
	$idProjet1 = htmlspecialchars($idProjet);
	$SQL = "SELECT COUNT(idProjet) FROM statutprojetclient WHERE idProjet='$idProjet1'";
	$nbr=SQLGetChamp($SQL);
	if($nbr==0){
		return 0;
	}else{
		return 1;
	}
}

function detailprojet($idProjet){
	$idProjet = htmlspecialchars($idProjet);
	$SQL = "SELECT * FROM statutprojetclient WHERE idProjet='$idProjet'";
	return parcoursRs(SQLSelect($SQL));
}
function detailadmin($idProjet){
	$idProjet = htmlspecialchars($idProjet);
	$SQL = "SELECT * FROM statutprojetadmin WHERE idProjet='$idProjet'";
	return parcoursRs(SQLSelect($SQL));
}

function facture($idProjet){
    $idProjet = htmlspecialchars($idProjet);
	$SQL = "SELECT * FROM facture WHERE idProjet='$idProjet'";
	return parcoursRs(SQLSelect($SQL));
}

function messageSuivi($idProjet){
	$idProjet = htmlspecialchars($idProjet);
	$SQL = "SELECT * FROM commentaires WHERE idProjet='$idProjet' AND publier='OUI'";
	return parcoursRs(SQLSelect($SQL));
}

function getnom($idProjet){
	$idProjet = htmlspecialchars($idProjet);
	$SQL = "SELECT NometPrenom FROM statutprojetclient WHERE idProjet='$idProjet'";
	return SQLGetChamp($SQL);
}

function getActu(){
	$SQL = "SELECT * FROM actualite WHERE archive='0' ORDER BY datepublication DESC";
	return parcoursRs(SQLSelect($SQL));
}

function getActu2($idActu){
    $idActu = htmlspecialchars($idActu);
	$SQL = "SELECT * FROM actualite WHERE idActu='$idActu'";
	return parcoursRs(SQLSelect($SQL));
}

function getActuarchive(){
    $SQL = "SELECT * FROM actualite WHERE archive='1' ORDER BY datepublication DESC";
	return parcoursRs(SQLSelect($SQL));
}

function insertActu($titre, $actu, $date,$datepubli,$email){
	$titre = htmlspecialchars($titre);
	$actu = htmlspecialchars($actu);
	$date = htmlspecialchars($date);
	$datepubli = htmlspecialchars($datepubli);
	$email = htmlspecialchars($email);
	$SQL = "INSERT INTO actualite VALUES ('$titre', '$actu', '$date', NULL,'$datepubli','$email','0')";
	SQLInsert($SQL);
}

function archiveActu($idActu){
	$idActu = htmlspecialchars($idActu);
	$SQL = "UPDATE actualite SET archive = '1' WHERE idActu = '$idActu'";
	SQLUpdate($SQL);
}

function mettreenligneActu($idActu){
    $idActu = htmlspecialchars($idActu);
	$SQL = "UPDATE actualite SET archive = '0' WHERE idActu = '$idActu'";
	SQLUpdate($SQL);
}

function getinfogeneral(){
	$SQL = "SELECT info FROM infogenerale";
	return SQLGetChamp($SQL);
}

function updateinfo($info){
	$info = htmlspecialchars($info);
	$SQL = "UPDATE infogenerale SET info = '$info'";
	SQLUpdate($SQL);
}

function deleteActu($idActu){
	$idActu = htmlspecialchars($idActu);
	$SQL = "DELETE FROM actualite WHERE idActu='$idActu'";
	SQLDelete($SQL);
}

function changermdp($pass, $newpass){
	$pass = htmlspecialchars($pass);
	$newpass = htmlspecialchars($newpass);
	$SQL = "UPDATE administration SET password = '$newpass' WHERE password = '$pass'";
	SQLUpdate($SQL);
}

function updateDate($date, $idActu){
    $date = htmlspecialchars($date);
    $idActu = htmlspecialchars($idActu);
    $SQL = "UPDATE actualite SET datepublication = '$date' WHERE idActu='$idActu'";
    SQLUpdate($SQL);
}
function updateTitre($titre, $idActu){
    $titre = htmlspecialchars($titre);
    $idActu = htmlspecialchars($idActu);
    $SQL = "UPDATE actualite SET titre = '$titre' WHERE idActu='$idActu'";
    SQLUpdate($SQL);
}
function updateActu($actu, $idActu){
    $actu = htmlspecialchars($actu);
    $idActu = htmlspecialchars($idActu);
    $SQL = "UPDATE actualite SET actu = '$actu' WHERE idActu='$idActu'";
    SQLUpdate($SQL);
}

function insertMessage($client, $date, $message){
    $client = htmlspecialchars($client);
    $date = htmlspecialchars($date);
    $SQL = "INSERT INTO message VALUES ('$client', '$date', '$message', NULL)";
	SQLInsert($SQL);
}

function getMessage(){
    $SQL = "SELECT * FROM message ORDER BY idMessage DESC";
	return parcoursRs(SQLSelect($SQL));
}

function getemail($idProjet){
    $idProjet = htmlspecialchars($idProjet);
    $SQL = "SELECT DISTINCT email FROM statutprojetclient WHERE idProjet='$idProjet' AND email IS NOT NULL";
    return SQLGetChamp($SQL);
}

function deleteMessage($idMessage){
    $idMessage = htmlspecialchars($idMessage);
	$SQL = "DELETE FROM message WHERE idMessage='$idMessage'";
	SQLDelete($SQL);
}

function getidProjet($nomClient){
    $nomClient = htmlspecialchars($nomClient);
	$SQL = "SELECT idProjet FROM statutprojetclient WHERE NometPrenom='$nomClient'";
    return SQLGetChamp($SQL);
}

/*function getFacture($idProjet){
    $idProjet = htmlspecialchars($idProjet);
	$SQL = "SELECT * FROM facture WHERE idProjet='$idProjet'";
	return parcoursRs(SQLSelect($SQL));
}*/
?>
