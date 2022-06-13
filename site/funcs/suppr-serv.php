<?php
// Script utilisé par la page admin.php pour supprimer un serveur
session_start();
require("connexion-base.php");

// éxecute le script seulement si toutes les options POST sont présentes et que l'admin est authentifié
if (isset($_SESSION["username"]) AND $_SESSION["username"] == "adminMulticast" AND isset($_POST["serv"])) {
	$serv = htmlspecialchars($_POST["serv"]);

	// vérifie que le serveur n'est pas en locations
	$check = $db->prepare("SELECT idLocation FROM serveurs WHERE id = ? AND enService = 1");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if (count($dataCheck) == 1 AND $dataCheck[0]["idLocation"] != NULL) {
		// termine la location et supprime le serveur
		$closeServ = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, serveurs.enService = 0, locations.finLoc = CURRENT_TIMESTAMP WHERE locations.id = serveurs.idLocation AND serveurs.id = ?");
		$closeServ->execute(array($serv));
		$closeServ->closeCursor();
	} else if (count($dataCheck) == 1) {
		// supprime le serveur
		$closeServ = $db->prepare("UPDATE serveurs SET enService = 0 WHERE id = ?");
		$closeServ->execute(array($serv));
		$closeServ->closeCursor();
	}
	header("Location: ../admin.php?table=serv");
	die();
}
?>
