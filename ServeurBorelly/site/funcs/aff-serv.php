<?php
session_start();
require("func-tableau.php");
require("connexion-base.php");

if (isset($_SESSION["username"]) AND isset($_POST["type"]) && isset($_POST["ram"]) && isset($_POST["cpu"])) {
	$type = htmlspecialchars($_POST["type"]);
	$cpu = htmlspecialchars($_POST["cpu"]);
	$ram = htmlspecialchars($_POST["ram"]);
	$typeset = array("JEU", "WEB", "STOCKAGE");
	$cpuset = array("8", "16", "32");
	$ramset = array("32", "128", "256");
	
	if (in_array($type, $typeset) AND in_array($ram, $ramset) AND in_array($cpu, $cpuset)) {
		$sql = "SELECT * FROM ServeursDispo WHERE Type='$type' AND CPU >= $cpu AND RAM >= $ram";
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json; charset=utf-8");
		tableau($db, $sql, "json");
	}
}

?>
