<?php
session_start();
require("connexion-base.php");
if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["mail"]) && isset($_POST["pass"]) && isset($_POST["pass2"])) {
	$nom = strtolower(htmlspecialchars($_POST["nom"]));
	$pre = strtolower(htmlspecialchars($_POST["prenom"]));
	$email = strtolower(htmlspecialchars($_POST["mail"]));
	$pass = htmlspecialchars($_POST["pass"]);
	$pass2 = htmlspecialchars($_POST["pass2"]);

	if (strlen($nom) > 50) {
		header("Location: ../inscription.php?err=nom_long");
		die();
	} else if (strlen($pre) > 50) {
		header("Location: ../inscription.php?err=pre_long");
		die();
	} else if (strlen($email) > 50) {
		header("Location: ../inscription.php?err=email_long");
		die();
	} else if ($pass !== $pass2) {
		header("Location: ../inscription.php?err=mdp");
		die();
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../inscription.php?err=email");
		die();
	}

	$query = $db->prepare("SELECT COUNT(*) FROM clients WHERE email = ?");
	$query->execute(array($email));
	$data = $query->fetch();
	$query->closeCursor();
	if ($data[0] != 0) {
		header("Location: ../inscription.php?err=existe");
		die();
	} 

	$new = $db->prepare("INSERT INTO clients (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, SHA1(:mdp))");
	$new->execute(array(
		"nom" => $nom,
		"prenom" => $pre,
		"email" => $email,
		"mdp" => $pass
	));

	if (isset($_GET["redirect"])) {
		$_SESSION["username"] = $email;
		$_SESSION["nomPrenom"] = $pre." ".strtoupper($nom);
		header("Location: ../".$_GET["redirect"]);
		die();
	} else {
		$_SESSION["username"] = $email;
		$_SESSION["nomPrenom"] = $pre." ".strtoupper($nom);
		header("Location: ../index.php");
		die();
	}
} else {
	header("Location: ../inscription.php");
	die();
}
?>
