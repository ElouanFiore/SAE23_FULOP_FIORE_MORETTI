<?php
// Script utilisé par la page compte.php pour modifier les infos d'un utilisateur
require_once("connexion-base.php");
session_start();

// S'éxécute pour la modification d'une donnée autre que le mdp
if (isset($_SESSION["username"]) AND isset($_POST["type"]) AND isset($_POST["nouveau"]) AND isset($_POST["password"])) {
	$type = htmlspecialchars($_POST["type"]);
	$nouveau = strtolower(htmlspecialchars($_POST["nouveau"]));
	$passwd = htmlspecialchars($_POST["password"]);

	// vérifie que le compte existe et que le mdp est le bon
	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) AND email=:email");
	$check->execute(array("passwd"=>$passwd, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	// Si le compte est inactif ne fais rien
	if (count($data) == 1 AND $data[0]["actif"] == 0) {
		header("Location: ../compte.php?erreur=inactif&type=".$type);
		die();
	// Si rien n'est retourné donne une erreur de mdp
	} else if (count($data) != 1) {
		header("Location: ../compte.php?erreur=mdp&type=".$type);
		die();
	// Si la nouvelle donnée est trop longue nen fais rien
	} else if (strlen($nouveau) > 50) {
		header("Location: ../compte.php?erreur=long&type=".$type);
		die();
	}

	$nom = $data[0]["nom"];
	$pre = $data[0]["prenom"];
	switch ($type) {
		// Si la nouvelle donnée est le nom
		case "nom";
			if ($nouveau !== $nom) {
				$query = $db->prepare("UPDATE clients SET nom = :nouveau WHERE email=:email");
				$query->execute(array("nouveau" => $nouveau, "email" => $_SESSION["username"]));
				
				// Recrée le variable qui sert à afficher le nom et le prenom
				$preformat = strtoupper($pre[0]).substr($pre, 1, strlen($pre));
				$_SESSION["nomPrenom"] = $preformat." ".strtoupper($nouveau);
			} else {
				header("Location: ../compte.php?erreur=meme&type=".$type);
				die();
			}
		break;
		// Si la nouvelle donnée est le prénom
		case "pre";
			if ($nouveau !== $pre) {
				$query = $db->prepare("UPDATE clients SET prenom = :nouveau WHERE email=:email");
				$query->execute(array("nouveau" => $nouveau, "email" => $_SESSION["username"]));

				// Recrée le variable qui sert à afficher le nom et le prenom
				$preformat = strtoupper($nouveau[0]).substr($nouveau, 1, strlen($nouveau));
				$_SESSION["nomPrenom"] = $preformat." ".strtoupper($nom);
			} else {
				header("Location: ../compte.php?erreur=meme&type=".$type);
				die();
			}
		break;
		// Si la nouvelle donnée est l'adresse mail
		case "mail";
			// Vérifie que l'adresse mail n'est pas déjà utilisé
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
	// Retroune vers la page compte avec le bon paramètre sans erreur
	header("Location: ../compte.php?erreur=no&type=".$type);
	die();

// S'éxécute pour la modification du mdp
} else if (isset($_SESSION["username"]) AND isset($_POST["type"]) AND isset($_POST["pass1"]) AND isset($_POST["pass2"]) AND isset($_POST["password"])) {
	$type = htmlspecialchars($_POST["type"]);
	$pass1 = htmlspecialchars($_POST["pass1"]);
	$pass2 = htmlspecialchars($_POST["pass2"]);
	$passwd = htmlspecialchars($_POST["password"]);

	// vérifie que le compte existe et que le mdp est le bon
	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) AND email=:email");
	$check->execute(array("passwd"=>$passwd, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	// Si le nouveau mdp n'est pas bien vérifié retourne une erreur
	if ($pass1 !== $pass2) {
		header("Location: ../compte.php?erreur=mememdp&type=".$type);
		die();
	// Si le compte est inactif ne fais rien
	} else if (count($data) == 1 AND $data[0]["actif"] == 0) {
		header("Location: ../compte.php?erreur=inactif&type=".$type);
		die();
	// Si rien n'est retourné donne une erreur de mdp
	} else if (count($data) != 1) {
		header("Location: ../compte.php?erreur=mdp&type=".$type);
		die();
	}

	// Vérifie que le nouveau mdp n'est pas le même que l'ancien
	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) AND email=:email");
	$check->execute(array("passwd"=>$pass1, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	// Retourne une erreur si le nouveau et l'ancien mdp sont les mêmes
	if (count($data) != 0) {
		header("Location: ../compte.php?erreur=meme&type=".$type);
		die();
	}

	// change le mdp
	$change = $db->prepare("UPDATE clients SET mdp = SHA1(:mdp) WHERE email=:email");
	$change->execute(array("mdp"=>$pass1, "email" => $_SESSION["username"]));
	$change->closeCursor();
	header("Location: ../compte.php?erreur=no&type=".$type);
	die();

// S'éxécute pour la suppression d'un compte
} else if (isset($_SESSION["username"]) AND isset($_POST["type"]) AND isset($_POST["password"]) AND $_POST["type"] === "del") {
	$type = htmlspecialchars($_POST["type"]);
	$passwd = htmlspecialchars($_POST["password"]);

	// vérifie que le compte existe et que le mdp est le bon
	$check = $db->prepare("SELECT actif, prenom, nom FROM clients WHERE mdp=SHA1(:passwd) AND email=:email");
	$check->execute(array("passwd"=>$passwd, "email" => $_SESSION["username"]));
	$data = $check->fetchAll();
	$check->closeCursor();

	// vérifie si le compte a des locations en cours
	$checkLoc = $db->prepare("SELECT COUNT(locations.id) AS c FROM locations, clients WHERE locations.idClient = clients.id AND locations.finLoc IS NULL AND clients.email = ?");
	$checkLoc->execute(array($_SESSION["username"]));
	$dataLoc = $checkLoc->fetchAll();
	$checkLoc->closeCursor();

	// Si le compte est inactif ne fais rien
	if (count($data) == 1 AND $data[0]["actif"] == 0) {
		header("Location: ../compte.php?erreur=inactif&type=".$type);
		die();
	// Si rien n'est retourné donne une erreur de mdp
	} else if (count($data) != 1) {
		header("Location: ../compte.php?erreur=mdp&type=".$type);
		die();
	}

	// Si des locations sont en cours elles sont terminé et le compte est supprimé
	if ($dataLoc[0]["c"] > 0) {
		$SupprCli = $db->prepare("UPDATE serveurs, locations, clients SET serveurs.idLocation = NULL, finLoc = CURRENT_TIMESTAMP, clients.actif = 0 WHERE serveurs.idLocation = locations.id AND locations.idClient = clients.id AND clients.email = ?");
		$SupprCli->execute(array($_SESSION["username"]));
		$SupprCli->closeCursor();
	// Si il n'a pas de locations le compte est juste supprimé
	} else {
		$SupprCli = $db->prepare("UPDATE clients SET actif = 0 WHERE email = ?");
		$SupprCli->execute(array($_SESSION["username"]));
		$SupprCli->closeCursor();
	}

	header("Location: ../funcs/logout.php");
	die();

// si aucune options n'est spécifié renvoie vers la page de gestions
} else {
	header("Location: ../compte.php");
	die();
}
?>
