<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["client"])) {
	$client = htmlspecialchars($_POST["client"]);

	$check = $db->prepare("SELECT COUNT(*) FROM clients WHERE id = ? AND actif = 1");
	$checkLoc = $db->prepare("SELECT COUNT(*) FROM locations WHERE idClient = ? AND finLoc IS NULL");
	$check->execute(array($client));
	$checkLoc->execute(array($client));
	$dataCheck = $check->fetchAll();
	$dataCheckLoc = $checkLoc->fetchAll();
	$check->closeCursor();
	$checkLoc->closeCursor();

	if ($dataCheck[0]["COUNT(*)"] == 1 AND $dataCheckLoc[0]["COUNT(*)"] > 0) {
		$SupprCli = $db->prepare("UPDATE serveurs, locations, clients SET serveurs.idLocation = NULL, finLoc = CURRENT_TIMESTAMP, clients.actif = 0 WHERE serveurs.idLocation = locations.id AND locations.idClient = clients.id AND clients.id = ?");
		$SupprCli->execute(array($client));
		$SupprCli->closeCursor();
	} else if ($dataCheck[0]["COUNT(*)"] == 1) {
		$SupprCli = $db->prepare("UPDATE clients SET actif = 0 WHERE id = ?");
		$SupprCli->execute(array($client));
		$SupprCli->closeCursor();
	}
	header("Location: ../admin.php?table=clients");
	die();
}
?>
