<?php
session_start();
require("connexion-base.php");
if(isset($_POST['username']) && isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	$stmt = $db->prepare("SELECT nom, prenom FROM clients WHERE email=:u && mdp=SHA1(:p);");
	$stmt->execute(array("u"=>$username, "p"=>$password));
	$rows=$stmt->fetchAll();
	$stmt->closeCursor();
	
	if (count($rows) == 1) {
		$_SESSION["username"] = $username;
		$_SESSION["nomPrenom"] = $rows[0]["prenom"]." ".strtoupper($rows[0]["nom"]);
		header('Location: ../'.$_GET["redirect"]);
		die();
	} else {
   		header('Location: ../login.php?err=1');
		die();
	}
} else {
	header('Location: ../login.php');
	die();
}
?>
