<?php
// utilisé par la page admin.php quand elle fait des requêtes fetch pour actualiser ses tables
session_start();

// si l'admin est authentifié et qu'il a bien demandé une table
if (isset($_SESSION["username"]) AND $_SESSION["username"] == "admin" AND isset($_POST["vue"])) {
	require("func-tableau.php");
	require("connexion-base.php");
	$vue = htmlspecialchars($_POST["vue"]);

	switch ($vue) {
		case "servs";
			// renvoie des données de type JSON pour que la page construise le tableau des serveurs
			header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json; charset=utf-8");
			tableau($db, "SELECT ID, Type, Cpu, Ram, Stockage, idLocation,  EnService FROM `serveurs` ORDER BY id DESC", "json");
		break;
		case "clients";
			// renvoie des données de type JSON pour que la page construise le tableau des clients
			header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json; charset=utf-8");
			tableau($db, "SELECT ID, Email, Nom, Prenom, Actif FROM `clients` WHERE email != 'admin' ORDER BY id DESC", "json");
		break;
		case "locs";
			// renvoie des données de type JSON pour que la page construise le tableau des locations
			header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json; charset=utf-8");
			tableau($db, "SELECT ID, IDclient, IDserveur, DebutLoc, FinLoc FROM `locations` ORDER BY id DESC", "json");
		break;
	}
}
?>
