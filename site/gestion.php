En construction

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
</head>
<body>
<?php
tableau($db, "SELECT IdServeur, Type, CPU, RAM, STOCKAGE FROM `VueClient` WHERE mail='".$_SESSION["username"]."'");
?>
</body>
</html>
