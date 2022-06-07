<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) AND isset($_POST["id"])) {
	$serv = htmlspecialchars($_POST["id"]);

	$check = $db->prepare("SELECT idLocation FROM serveurs WHERE id = ? AND enService = 1 AND idLocation IS NULL");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if (count($dataCheck) == 1) {
		$openLoc = $db->prepare("INSERT INTO locations (idServeur, idClient, debutLoc) SELECT :serv, id, CURRENT_TIMESTAMP FROM clients WHERE email=:mail");
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
