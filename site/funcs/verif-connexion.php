<?php
session_start();
require("connexion-base.php");
if(isset($_POST['username']) && isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	$stmt = $db->prepare("SELECT nom, prenom, actif FROM clients WHERE email=:u && mdp=SHA1(:p);");
	$stmt->execute(array("u"=>$username, "p"=>$password));
	$rows=$stmt->fetchAll();
	$stmt->closeCursor();
	
	if (isset($_GET["redirect"])) {
		$get = "&redirect=".$_GET["redirect"];
	} else {
		$get = "";
	}

	if (count($rows) != 1) {
   		header('Location: ../login.php?err=inexistant'.$get);
		die();
	} else if ($rows[0]["actif"] == 0) {
   		header('Location: ../login.php?err=supprime'.$get);
		die();
	}

	$nom = strtoupper($rows[0]["nom"]);
	$pre = $rows[0]["prenom"];
	$lenpre = strlen($rows[0]["prenom"]);
	$preformat = strtoupper($pre[0]).substr($pre, 1, $lenpre);

	$_SESSION["nomPrenom"] = $preformat." ".$nom;
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
