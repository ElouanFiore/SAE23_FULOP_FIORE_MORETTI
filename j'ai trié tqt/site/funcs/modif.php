<?php
require_once("connexion-base.php");
session_start();
if (isset($_POST["type"]) && isset($_POST["nouveau"]) && isset($_POST["password"])) {
	$type = htmlspecialchars($_POST["type"]);
	$nouveau = strtolower(htmlspecialchars($_POST["nouveau"]));
	$passwd = htmlspecialchars($_POST["password"]);

	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) && email=:email");
	$check->execute(array("passwd"=>$passwd, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	if (count($data) == 1 && $data[0]["actif"] == 0) {
		header("Location: ../compte.php?erreur=inactif&type=".$type);
		die;
	} else if (count($data) != 1) {
		header("Location: ../compte.php?erreur=mdp&type=".$type);
		die;
	} else if (strlen($nouveau) > 50) {
		header("Location: ../compte.php?erreur=long&type=".$type);
		die;
	}

	$nom = $data[0]["nom"];
	$pre = $data[0]["prenom"];
	switch ($type) {
		case "nom";
			if ($nouveau !== $nom) {
				$query = $db->prepare("UPDATE clients SET nom = :nouveau WHERE email=:email");
				$query->execute(array("nouveau" => $nouveau, "email" => $_SESSION["username"]));
				
				$preformat = strtoupper($pre[0]).substr($pre, 1, strlen($pre));
				$_SESSION["nomPrenom"] = $preformat." ".strtoupper($nouveau);
			} else {
				header("Location: ../compte.php?erreur=meme&type=".$type);
				die();
			}
		break;
		case "pre";
			if ($nouveau !== $pre) {
				$query = $db->prepare("UPDATE clients SET prenom = :nouveau WHERE email=:email");
				$query->execute(array("nouveau" => $nouveau, "email" => $_SESSION["username"]));

				$preformat = strtoupper($nouveau[0]).substr($nouveau, 1, strlen($nouveau));
				$_SESSION["nomPrenom"] = $preformat." ".strtoupper($nom);
			} else {
				header("Location: ../compte.php?erreur=meme&type=".$type);
				die();
			}
		break;
		case "mail";
			$verif = $db->prepare("SELECT * FROM clients WHERE email=:email");
			$verif->execute(array("email" => $nouveau));
			$data = $verif->fetchAll();
			$verif->closeCursor();

			if ($nouveau === $_SESSION["username"]) {
				header("Location: ../compte.php?erreur=meme&type=".$type);
				die();
			} else if (count($data) != 0) {
				header("Location: ../compte.php?erreur=utilise&type=".$type);
				die();
			} else if (!filter_var($nouveau, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../compte.php?erreur=invalide&type=".$type);
				die();
			} else {
				$query = $db->prepare("UPDATE clients SET email = :nouveau WHERE email=:email");
				$query->execute(array("nouveau" => $nouveau, "email" => $_SESSION["username"]));
				$_SESSION["username"] = $nouveau;
			}
		break;
	}
	$query->closeCursor();
	header("Location: ../compte.php?erreur=no&type=".$type);

} else if (isset($_POST["type"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]) && isset($_POST["password"])) {
	$type = htmlspecialchars($_POST["type"]);
	$pass1 = htmlspecialchars($_POST["pass1"]);
	$pass2 = htmlspecialchars($_POST["pass2"]);
	$passwd = htmlspecialchars($_POST["password"]);

	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) && email=:email");
	$check->execute(array("passwd"=>$passwd, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	if ($pass1 !== $pass2) {
		header("Location: ../compte.php?erreur=mememdp&type=".$type);
		die;
	} else if (count($data) == 1 && $data[0]["actif"] == 0) {
		header("Location: ../compte.php?erreur=inactif&type=".$type);
		die;
	} else if (count($data) != 1) {
		header("Location: ../compte.php?erreur=mdp&type=".$type);
		die;
	}

	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) && email=:email");
	$check->execute(array("passwd"=>$pass1, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	if (count($data) != 0) {
		header("Location: ../compte.php?erreur=meme&type=".$type);
		die;
	}

	$change = $db->prepare("UPDATE clients SET mdp = SHA1(:mdp) WHERE email=:email");
	$change->execute(array("mdp"=>$pass1, "email" => $_SESSION["username"]));
	$change->closeCursor();
	header("Location: ../compte.php?erreur=no&type=".$type);
} else if (isset($_POST["type"]) && isset($_POST["password"]) && $_POST["type"] === "del") {
	$type = htmlspecialchars($_POST["type"]);
	$passwd = htmlspecialchars($_POST["password"]);
	
	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) && email=:email");
	$check->execute(array("passwd"=>$passwd, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	if (count($data) == 1 && $data[0]["actif"] == 0) {
		header("Location: ../compte.php?erreur=inactif&type=".$type);
		die;
	} else if (count($data) != 1) {
		header("Location: ../compte.php?erreur=mdp&type=".$type);
		die;
	}

	$change = $db->prepare("UPDATE clients SET actif = 0  WHERE email=:email");
	$change->execute(array("email" => $_SESSION["username"]));
	$change->closeCursor();
	header("Location: ../funcs/logout.php");
} else {
	header("Location: ../compte.php");
	die();
}
?>
