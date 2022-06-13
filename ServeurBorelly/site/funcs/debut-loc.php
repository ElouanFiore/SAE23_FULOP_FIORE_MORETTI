<?php
// script utilisé par la page louer pour ouvrir une location
session_start();
require("connexion-base.php");

// execute le script seulement si toutes les options POST sont présentes et qu'un utilisateur est authentifié
if (isset($_SESSION["username"]) AND isset($_POST["id"])) {
	$serv = htmlspecialchars($_POST["id"]);

	// Vérifie que le serveur existe et qu'il n'est pas déjà loué
	$check = $db->prepare("SELECT idLocation FROM serveurs WHERE id = ? AND enService = 1 AND idLocation IS NULL");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if (count($dataCheck) == 1) {
		// crée une nouvelle ligne dans la table des locations
		$openLoc = $db->prepare("INSERT INTO locations (idServeur, idClient, debutLoc) SELECT :serv, id, CURRENT_TIMESTAMP FROM clients WHERE email=:mail");
		// Défini le serveurs comme loué dans la table des serveurs
		$reservServ = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = locations.id WHERE serveurs.id = locations.idServeur AND locations.finLoc IS NULL AND locations.idServeur = ?");
		$openLoc->execute(array("serv" => $serv, "mail" => $_SESSION["username"]));
		$reservServ->execute(array($serv));
		$openLoc->closeCursor();
		$reservServ->closeCursor();
		header("Location: ../gestion.php?res=add");
		die();
	}
}
?>
