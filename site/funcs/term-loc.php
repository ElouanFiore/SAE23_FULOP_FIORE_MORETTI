<?php
// utilisé par les pages admin.php et gestion.php pour terminer une location
session_start();
require("connexion-base.php");

// si l'admin est authentifié et qu'il demande une suppresion
if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["loc"])) {
	$loc = htmlspecialchars($_POST["loc"]);

	// vérifie que la location existe bien
	$check = $db->prepare("SELECT id FROM locations WHERE id = ? AND finLoc IS NULL");
	$check->execute(array($loc));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if ($dataCheck["0"]["id"] == $loc) {
		// termine la location et rend le serveur libre
		$endLoc = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, finLoc = CURRENT_TIMESTAMP WHERE serveurs.idLocation = locations.id AND locations.id = ?");
		$endLoc->execute(array($loc));
		$endLoc->closeCursor();
		
		header("Location: ../admin.php?table=locs");
		die();
	}
// si c'est un client authentifié qui demande une fin de location
} else if (isset($_SESSION["username"]) AND isset($_POST["serv"])) {
 	$serv = htmlspecialchars($_POST["serv"]);

	// vérifie que la location appartienne bien au client
	$check = $db->prepare("SELECT mail FROM VueClient WHERE fin IS NULL AND IdServeur = ?");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if ($dataCheck[0]["mail"] == $_SESSION["username"]) {
		// termine la location et rend le serveur libre
		$endLoc = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, locations.finLoc = CURRENT_TIMESTAMP WHERE locations.id = serveurs.idLocation AND serveurs.id = ?");
		$endLoc->execute(array($serv));
		$endLoc->closeCursor();
		
		header("Location: ../gestion.php?res=del");
		die();
	}
}
?>
