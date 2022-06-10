<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["serv"])) {
	$serv = htmlspecialchars($_POST["serv"]);

	$check = $db->prepare("SELECT idLocation FROM serveurs WHERE id = ? AND enService = 1");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if (count($dataCheck) == 1 AND $dataCheck[0]["idLocation"] != NULL) {
		$closeServ = $db->prepare("UPDATE serveurs, locations SET serveurs.idLocation = NULL, serveurs.enService = 0, locations.finLoc = CURRENT_TIMESTAMP WHERE locations.id = serveurs.idLocation AND serveurs.id = ?");
		$closeServ->execute(array($serv));
		$closeServ->closeCursor();
	} else if (count($dataCheck) == 1) {
		$closeServ = $db->prepare("UPDATE serveurs SET enService = 0 WHERE id = ?");
		$closeServ->execute(array($serv));
		$closeServ->closeCursor();
	}
	header("Location: ../admin.php?table=serv");
	die();
}
?>
