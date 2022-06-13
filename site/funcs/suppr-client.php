<?php
// Script utilisé par la page admin.php pour supprimer un utilisateur
session_start();
require("connexion-base.php");

// éxecute le script seulement si toutes les options POST sont présentes et que l'admin est authentifié
if (isset($_SESSION["username"]) AND $_SESSION["username"] == "adminMulticast" AND isset($_POST["client"])) {
	$client = htmlspecialchars($_POST["client"]);

	// vérifie que le client existe et si il a des locations en cours
	$check = $db->prepare("SELECT COUNT(*) FROM clients WHERE id = ? AND actif = 1");
	$checkLoc = $db->prepare("SELECT COUNT(*) FROM locations WHERE idClient = ? AND finLoc IS NULL");
	$check->execute(array($client));
	$checkLoc->execute(array($client));
	$dataCheck = $check->fetchAll();
	$dataCheckLoc = $checkLoc->fetchAll();
	$check->closeCursor();
	$checkLoc->closeCursor();

	if ($dataCheck[0]["COUNT(*)"] == 1 AND $dataCheckLoc[0]["COUNT(*)"] > 0) {
		// supprime le client et termine ses locations
		$SupprCli = $db->prepare("UPDATE serveurs, locations, clients SET serveurs.idLocation = NULL, finLoc = CURRENT_TIMESTAMP, clients.actif = 0 WHERE serveurs.idLocation = locations.id AND locations.idClient = clients.id AND clients.id = ?");
		$SupprCli->execute(array($client));
		$SupprCli->closeCursor();
	} else if ($dataCheck[0]["COUNT(*)"] == 1) {
		// supprime le client
		$SupprCli = $db->prepare("UPDATE clients SET actif = 0 WHERE id = ?");
		$SupprCli->execute(array($client));
		$SupprCli->closeCursor();
	}
	header("Location: ../admin.php?table=clients");
	die();
}
?>
