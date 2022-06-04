<?php
session_start();
require("connexion-base.php");
if(isset($_POST['username']) AND isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	if (isset($_GET["redirect"])) {
		$get = "&redirect=".$_GET["redirect"];
	} else {
		$get = "";
	}

	$stmt = $db->prepare("SELECT id, nom, prenom, actif FROM clients WHERE email=:u AND mdp=SHA1(:p);");
	$stmt->execute(array("u"=>$username, "p"=>$password));
	$rows=$stmt->fetchAll();
	$stmt->closeCursor();
	
	if (!filter_var($username, FILTER_VALIDATE_EMAIL) AND $username !== "admin") {
   		header('Location: ../login.php?err=mail'.$get);
		die();
	} else if (count($rows) != 1) {
   		header('Location: ../login.php?err=inexistant'.$get);
		die();
	} else if ($rows[0]["actif"] == 0) {
		header('Location: ../login.php?err=supprime'.$get);
		die();
	}

	if ($rows[0]["id"] == 1) {
		$nomprenom = "admin";
	} else {
		$nom = strtoupper($rows[0]["nom"]);
		$pre = $rows[0]["prenom"];
		$lenpre = strlen($rows[0]["prenom"]);
		$preformat = strtoupper($pre[0]).substr($pre, 1, $lenpre);
		$nomprenom = $preformat." ".$nom;
	}

	$_SESSION["nomPrenom"] = $nomprenom;
	$_SESSION["username"] = $username;
		
	if ($get !== "") {
		header('Location: ../'.$_GET["redirect"]);
		die();
	} else {
		header('Location: ../index.html');
		die();
	}
} else {
	header('Location: ../login.php');
	die();
}
?>
