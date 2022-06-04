<?php
session_start();
if (!isset($_SESSION["username"])) {
	header("Location: login.php?redirect=gestion.php");
	die();
}
require_once("funcs/connexion-base.php");
require_once("funcs/func-tableau.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
	<title>Gestion des Serveurs</title>
	<link rel="stylesheet" href="css/tarifs.css">
 	<script src="funcs/func-tableau.js"></script>
</head>
<body>
<div id="table"></div>
<script>
<?php
tableau($db, "SELECT Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE, enService FROM `VueClient` WHERE mail='".$_SESSION["username"]."'", "locs");
?>
Table(locs, locs);
</script>
</body>
</html>
