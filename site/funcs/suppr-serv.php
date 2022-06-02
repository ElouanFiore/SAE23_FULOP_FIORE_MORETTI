<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) && $_SESSION["username"] == "admin" && isset($_POST["serv"])) {
	$serv = htmlspecialchars($_POST["serv"]);

	$check = $db->prepare("SELECT idLocation FROM serveurs WHERE id = ?");
	$check->execute(array($serv));
	$dataCheck = $check->fetchAll();
	$check->closeCursor();

	if ($dataCheck[0]["idLocation"] != 0) {
		$endLoc1 = $db->prepare("UPDATE locations SET finLoc = CURRENT_TIMESTAMP WHERE idServeur = ?");
		$closeServ = $db->prepare("UPDATE serveurs SET idLocation = NULL, enService = 0 WHERE id = ?");
		$endLoc1->execute(array($serv));
		$closeServ->execute(array($serv));
		$endLoc1->closeCursor();
		$closeServ->closeCursor();
	} else {
		$closeServ = $db->prepare("UPDATE serveurs SET enService = 0 WHERE id = ?");
		$closeServ->execute(array($serv));
		$closeServ->closeCursor();
	}
	header("Location: ../admin.php");
}
?>
