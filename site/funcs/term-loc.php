<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["loc"])) {
	$loc = htmlspecialchars($_POST["loc"]);

	$check = $db->prepare("SELECT id FROM locations WHERE id = ? AND finLoc IS NULL");
	$check->execute(array($loc));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if ($dataCheck["0"]["id"] == $loc) {
		$endLoc = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, finLoc = CURRENT_TIMESTAMP WHERE serveurs.idLocation = locations.id AND locations.id = ?");
		$endLoc->execute(array($loc));
		$endLoc->closeCursor();
	}
	header("Location: ../admin.php?table=locs");
	die();
} else if (isset($_SESSION["username"]) AND isset($_POST["serv"])) {
 	$serv = htmlspecialchars($_POST["serv"]);

	$check = $db->prepare("SELECT mail FROM VueClient WHERE IdServeur = ?");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if ($dataCheck[0]["mail"] == $_SESSION["username"]) {
		$endLoc = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, locations.finLoc = CURRENT_TIMESTAMP WHERE locations.id = serveurs.idLocation AND serveurs.id = ?");
		$endLoc->execute(array($serv));
		$endLoc->closeCursor();
	}
	header("Location: ../gestion.php?res=del");
	die();
}
?>
