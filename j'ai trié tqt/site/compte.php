<?php
session_start();
if (!isset($_SESSION["username"])) {
	header("Location: login.php?redirect=compte.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Informations personnelles</title>
</head>
<body>
<form action='funcs/modif.php' method='POST'>
	<h1>Modifier des informations</h1>
	
	<select name="type" id="select">
		<option value="nom">Changer le nom</option>
		<option value="pre">Changer le prénom</option>
		<option value="mdp">Changer le mot de passe</option>
		<option value="mail">Changer l'e-mail</option>
		<option value="del">Supprimer le compte</option>
	</select>

	<div id ="clean">
	</div>

	<label><b>Confirmez avec votre mot de passe actuel</b></label>
	<input type="password" placeholder="Mot de passe" name="password" required>

	<input type="submit" id='submit' value="Valider">

	<?php
	if (isset($_GET["erreur"])) {
		switch($_GET["erreur"]) {
			case "mdp";
				echo "<h4 style='color: red;'>Le mot de passe actuel est incorrect</h4>";
			break;
			case "inactif";
				echo "<h4 style='color: red;'>Ce compte à été supprimé</h4>";
			break;
			case "long";
				echo "<h4 style='color: red;'>La nouvelle donnée est trop longue</h4>";
			break;
			case "meme";
				echo "<h4 style='color: red;'>La nouvelle donnée et l'ancienne sont les mêmes</h4>";
			break;
			case "no";
				echo "<h4 style='color: green;'>La donnée à bien été mise à jour</h4>";
			break;
			case "mememdp";
				echo "<h4 style='color: red;'>Les nouveaux mots de passes ne correspondent pas</h4>";
			break;
			case "utilise";
				echo "<h4 style='color: red;'>Cette adresse e-mail est déjà utilisé</h4>";
			break;
			case "invalide";
				echo "<h4 style='color: red;'>Cette adresse e-mail est invalide</h4>";
			break;
		}
	}
	?>
	<p>Multicast ~ Votre hébergeur</p>
</form>
<script>
var valeurs = {
	pre:[
		{
			tag:"label",
			html:"<b>Votre nouveau prénom</b>"
		},
		{
			tag:"input",
			placeholder: "Nouveau prénom",
			type: "text",
			name: "nouveau"
		}
	],
	nom:[
		{
			tag:"label",
			html:"<b>Votre nouveau nom</b>"
		},
		{
			tag:"input",
			placeholder: "Nouveau nom", 
			type: "text",
			name: "nouveau"
		}
	],
	mail:[
		{
			tag:"label",
			html:"<b>Votre nouvel e-mail</b>"
		}, 
		{
			tag:"input",
			placeholder: "Nouvel e-mail",
			type: "email",
			name: "nouveau"
		}
	],
	mdp:[
		{
			tag:"label",
			html:"<b>Votre nouveau mot de passe</b>"
		},
		{
			tag:"input",
			placeholder: "Nouveau mot de passe",
			type: "password",
			name: "pass1"
		},
		{
			tag:"label",
			html:"<b>Re-tapez votre nouveau mot de passe</b>"
		},
		{
			tag:"input",
			placeholder: "Nouveau mot de passe",
			type: "password",
			name: "pass2"
		}
	],
	del: [
	],
};

var roulette = document.getElementById("select");
var clean = document.getElementById("clean");

function Change(val) {
	clean.innerHTML = "";
	roulette.value = val;
	valeurs[val].forEach(val => {
		let n = document.createElement(val.tag);
		if (val.tag == "input") {
			n.required = true;
		}
		Object.keys(val).forEach(k => {
			if (k == "html") {
				n.innerHTML = val.html;
			} else if (k != "tag") {
				n.setAttribute(k, val[k]);
			}
		});
		clean.appendChild(n);
	});
};

roulette.addEventListener("change", function() {
	Change(roulette.value);
});
<?php
if (isset($_GET["type"])) {
	switch($_GET["type"]) {
		case "pre";
			echo "Change('pre');";
		break;
		case "nom";
			echo "Change('nom');";
		break;
		case "mdp";
			echo "Change('mdp');";
		break;
		case "mail";
			echo "Change('mail');";
		break;
		case "del";
			echo "Change('del');";
		break;
	};
} else {
	echo "Change('nom');";
}
?>
</script>
</body>
</html>
