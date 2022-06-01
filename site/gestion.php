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
 	<link rel="stylesheet" href="css/tarifs.css">
</head>
<body>
<div id="table"></div>
<script>
<?php
tableau($db, "SELECT Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE, enService FROM `VueClient` WHERE mail='".$_SESSION["username"]."'");
?>

function Table(sql = table) {
	let affiche = document.createElement("table");

	let ligne = document.createElement("tr");
	sql.header.forEach(header => {
		let cellule = document.createElement("th");
		cellule.onclick = function() {
			Tri(this.innerHTML, table);
		};
		cellule.innerHTML = header;
		ligne.appendChild(cellule);	
	});
	affiche.appendChild(ligne);
	
	sql.row.forEach(row => {
		let ligne = document.createElement("tr");
		row.forEach(data => {
			let cellule = document.createElement("td");
			cellule.innerHTML = data;
			ligne.appendChild(cellule);	
		});
		affiche.appendChild(ligne);
	});
	document.getElementById("table").appendChild(affiche);
}

function leTri(a, b) {
	let c = a - b;
	
	if (isNaN(c)) {
		c = [a, b];
		c.sort();
		let indexa = c.indexOf(a);
		let indexb = c.indexOf(b);
		if (indexa < indexb) {
			return -1;
		} else {
			return 1;
		}
	} else {
		return c;
	}
};

function Tri(header, table) {
	let sens = header.split(" ")[1];
	let titre = header.split(" ")[0];
	let index = table.header.indexOf(titre+" \u2796");
	let sorted = JSON.parse(JSON.stringify(table));

	if (sens == "\u2B07") {
		sorted.row.sort(function(a, b) {
			return leTri(b[index], a[index]);
		});
		sorted.header[index] = titre+" \u2B06";
	} else if (sens == "\u2B06") {
		sorted = JSON.parse(JSON.stringify(table));
	} else {
		sorted.row.sort(function(a, b) {
			return leTri(a[index], b[index]);
		});
		sorted.header[index] = titre+" \u2B07";
	}
	document.getElementById("table").innerHTML = "";
	Table(sorted);
}
Table();
</script>
</body>
</html>
