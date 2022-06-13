<?php
// utilisé par inscription.php pour inscrire un utilisateur
session_start();
require("connexion-base.php");

// si toutes les options POST sont bien renseigné
if (isset($_POST["nom"]) AND isset($_POST["prenom"]) AND isset($_POST["mail"]) AND isset($_POST["pass"]) AND isset($_POST["pass2"])) {
	$nom = strtolower(htmlspecialchars($_POST["nom"]));
	$pre = strtolower(htmlspecialchars($_POST["prenom"]));
	$email = strtolower(htmlspecialchars($_POST["mail"]));
	$pass = htmlspecialchars($_POST["pass"]);
	$pass2 = htmlspecialchars($_POST["pass2"]);

	// pour conserver la redirection vers une autre page si il y a une erreur
	if (isset($_GET["redirect"])) {
		$get = "&redirect=".$_GET["redirect"];
	} else {
		$get = "";
	}

	if (strlen($nom) > 50) {
		// si le nom est trop long pour la bdd
		header("Location: ../inscription.php?err=nom_long".$get);
		die();
	} else if (strlen($pre) > 50) {
		// si le prenom est trop long pour la bdd
		header("Location: ../inscription.php?err=pre_long".$get);
		die();
	} else if (strlen($email) > 50) {
		// si l'adresse email est trop longue pour la bdd
		header("Location: ../inscription.php?err=email_long".$get);
		die();
	} else if ($pass !== $pass2) {
		// si le mot de passe n'est pas correctement vérifié
		header("Location: ../inscription.php?err=mdp".$get);
		die();
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// si l'adresse email n'est pas valide
		header("Location: ../inscription.php?err=email".$get);
		die();
	}

	// vérifie si un client n'est pas déjà inscrit avec cette adresse email
	$query = $db->prepare("SELECT actif FROM clients WHERE email = ?");
	$query->execute(array($email));
	$data = $query->fetchAll();
	$query->closeCursor();

	if (count($data) != 0 AND $data["actif"] == 0) {
		// si un client est inscrit mais qu'il est supprimé
		header("Location: ../inscription.php?err=inactif".$get);
		die();
	} else if (count($data) != 0) {
		// si un client est inscrit
		header("Location: ../inscription.php?err=existe".$get);
		die();
	}

	// ajoute le client à la bdd
	$new = $db->prepare("INSERT INTO clients (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, SHA1(:mdp))");
	$new->execute(array(
		"nom" => $nom,
		"prenom" => $pre,
		"email" => $email,
		"mdp" => $pass
	));

	// formate une chaine de caractères pour la faire apparaitre sur la page index.php
	$nomformat = strtoupper($nom);
	$lenpre = strlen($pre);
	$preformat = strtoupper($pre[0]).substr($pre, 1, $lenpre);
	$_SESSION["username"] = $email;
	$_SESSION["nomPrenom"] = $preformat." ".$nomformat;


	if (isset($_GET["redirect"])) {
		// redirige vers la page demandé
		header("Location: ../".$_GET["redirect"]);
		die();
	} else {
		header("Location: ../index.php");
		die();
	}
} else {
	header("Location: ../inscription.php");
	die();
}
?>