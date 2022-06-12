<?php
// utilisé par login.php pour authentifier un utilisateur
session_start();
require("connexion-base.php");

// si toutes les options POST sont bien renseigné
if(isset($_POST['username']) AND isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	// pour conserver la redirection vers une autre page si il y a une erreur
	if (isset($_GET["redirect"])) {
		$get = "&redirect=".$_GET["redirect"];
	} else {
		$get = "";
	}

	// vérifie l'adresse email et le mot de passe
	$stmt = $db->prepare("SELECT id, nom, prenom, actif FROM clients WHERE email=:u AND mdp=SHA1(:p);");
	$stmt->execute(array("u"=>$username, "p"=>$password));
	$rows=$stmt->fetchAll();
	$stmt->closeCursor();
	
	if (!filter_var($username, FILTER_VALIDATE_EMAIL) AND $username !== "admin") {
		// si l'username n'est pas une adresse email valide ou "admin"
   		header('Location: ../login.php?err=mail'.$get);
		die();
	} else if (count($rows) != 1) {
		// si rien n'est trouvé
   		header('Location: ../login.php?err=inexistant'.$get);
		die();
	} else if ($rows[0]["actif"] == 0) {
		// si le compte à été supprimé
		header('Location: ../login.php?err=supprime'.$get);
		die();
	}

	
	if ($rows[0]["id"] == 1) {
		// utilise admin comme moyen d'authentification
		$nomprenom = "admin";
	} else {
		// formate une chaine de caractères pour la faire apparaitre sur la page index.php
		$nom = strtoupper($rows[0]["nom"]);
		$pre = $rows[0]["prenom"];
		$lenpre = strlen($rows[0]["prenom"]);
		$preformat = strtoupper($pre[0]).substr($pre, 1, $lenpre);
		$nomprenom = $preformat." ".$nom;
	}

	$_SESSION["nomPrenom"] = $nomprenom;
	$_SESSION["username"] = $username;
		
	if ($get !== "") {
		// redirige vers la page demandé
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
