<?php
session_start();

if (isset($_SESSION["username"]) AND isset($_POST["vue"])) {
	require("func-tableau.php");
	require("connexion-base.php");
	$vue = htmlspecialchars($_POST["vue"]);

	switch ($vue) {
		case "servs";
			header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json; charset=utf-8");
			tableau($db, "SELECT ID, Type, Cpu, Ram, Stockage, idLocation,  EnService FROM `serveurs` ORDER BY id DESC", "json");
		break;
		case "clients";
			header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json; charset=utf-8");
			tableau($db, "SELECT ID, Email, Nom, Prenom, Actif FROM `clients` WHERE email != 'admin' ORDER BY id DESC", "json");
		break;
		case "locs";
			header('Access-Control-Allow-Origin: *');
			header("Content-Type: application/json; charset=utf-8");
			tableau($db, "SELECT ID, IDclient, IDserveur, DebutLoc, FinLoc FROM `locations` ORDER BY id DESC", "json");
		break;
	}
}
?>
