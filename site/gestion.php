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
tableau($db, "SELECT IdServeur, Type, CPU, RAM, STOCKAGE FROM `VueClient` WHERE mail='".$_SESSION["username"]."'");
?>
Table(table);
</script>
</body>
</html>
