<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["loc"])) {
	$loc = htmlspecialchars($_POST["loc"]);

	$check = $db->prepare("SELECT COUNT(*) FROM locations WHERE id = ? AND finLoc IS NULL");
	$check->execute(array($loc));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if ($dataCheck["0"]["COUNT(*)"] == 1) {
		$endLoc = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, finLoc = CURRENT_TIMESTAMP WHERE serveurs.idLocation = locations.id AND locations.id = ?");
		$endLoc->execute(array($loc));
		$endLoc->closeCursor();
	}
	header("Location: ../admin.php?table=locs");
	die();
}
?>
