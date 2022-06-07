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
	<link rel="stylesheet" href="css/style3.css">
 	<script src="funcs/func-tableau.js"></script>
</head>

<body>
	<nav>
		<div class="onglets">
			<a href="index.php">🏠 Accueil</a>
		</div>
	</nav>

	<div class="titre">
		<h1>Espace de gestion de serveurs loués</h1>
	</div>

	<?php
	if (isset($_GET["res"])) {
		switch($_GET["res"]) {
			case "del";
				echo "<h1 class='info' style='color: green;'>La locations à été terminé.</h1>";
			break;
			case "add";
				echo "<h1 class='info' style='color: green;'>Le serveur à bien été loué.</h1>";
			break;
		}
	}
	?>

	<div id="selection">
		<input onchange="Actif()" value="actif" type="checkbox" id="activation"/>
		<label for="activation">Afficher seulement les locations en cours</label>
	</div>


	<div id="table"></div>

	<script>
	
	<?php
	tableau($db, "SELECT Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE FROM `VueClient` WHERE mail='".$_SESSION["username"]."'", "locs");
	?>
	
	locs.header.push("Action");
	locs.row.forEach(val => {
		if (val[1] == "") {
			let id = val[2];
			let click = "<span onclick='Rendre("+id+")' style='cursor: pointer;'>Rendre</span>";
			val.push(click);
		} else {
			let click = "<span style='color: grey;'>Rendre</span>";
			val.push(click);
		}
	});

	function Rendre(id) {
		var formul = document.createElement("form");
		formul.method = "POST";
		formul.action = "funcs/term-loc.php";

		var input = document.createElement("input");
		input.type = "hidden"; 
		input.name = "serv"; 
		input.value = id; 
		formul.appendChild(input); 
		document.body.appendChild(formul); 
		formul.submit();
	}

	function Actif() {
		document.getElementById("table").innerHTML = "";
		var index = 1;
		var newTable = JSON.parse(JSON.stringify(locs));
		var condition = "";

		if (document.getElementById("activation").checked) {
			newTable.header.splice(index, 1);
			let len = newTable.row.length;
			let temp = [];
			for (let i = 0; i < len; i++) {
				if (newTable.row[i][index] == condition) {
					newTable.row[i].splice(index, 1);
					temp.push(newTable.row[i]);
				}
			}
			delete newTable.row;
			newTable.row = temp;
			Table(newTable, newTable);
		} else {
			Table(locs, locs);
		}
	}

	Table(locs, locs);
	</script>
</body>
</html>
