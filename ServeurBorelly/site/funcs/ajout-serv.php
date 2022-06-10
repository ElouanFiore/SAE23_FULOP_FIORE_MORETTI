<?php
session_start();
require("connexion-base.php");

if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["type"]) AND isset($_POST["ram"]) AND isset($_POST["cpu"]) AND isset($_POST["stockage"])) {
	$ram = htmlspecialchars($_POST["ram"]);
	$cpu = htmlspecialchars($_POST["cpu"]);
	$type = htmlspecialchars($_POST["type"]);
	$stockage = htmlspecialchars($_POST["stockage"]);

	$cpuDispo = array("8", "16", "32");
	$ramDispo = array("32", "128", "256");
	$typeDispo = array("JEU", "STOCKAGE", "WEB");

	if (in_array($type, $typeDispo) AND in_array($ram, $ramDispo) AND in_array($cpu, $cpuDispo) AND is_numeric($stockage)) {
		$ajoutServ = $db->prepare("INSERT INTO serveurs (type, cpu, ram, stockage) VALUES (:type, :cpu, :ram, :stockage)");
		$ajoutServ->execute(array("type"=>$type, "cpu"=>$cpu, "ram"=>$ram, "stockage"=>$stockage));
		$ajoutServ->closeCursor();
		header("Location: ../admin.php?table=serv");
		die();
	} else if (!is_numeric($stockage)) {
		header("Location: ../admin.php?table=serv&err=stock");
		die();
	}
}
?>
