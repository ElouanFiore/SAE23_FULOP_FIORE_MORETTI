<?php
session_start();
if (!(isset($_SESSION["username"]) AND $_SESSION["username"] == "admin")) {
	header("Location: index.php");
}
require("funcs/func-tableau.php");
require("funcs/connexion-base.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/styleAdmin.css" media="screen" type="text/css" />
 	<script src="funcs/func-tableau.js"></script>
</head>


<body>
	<nav>
		<div class="onglets">
			<a href="index.php">🏠 Accueil</a>
		</div>
	</nav>

	<div class="gestion">
		<h1>Pannel de gestion et d'administration des serveurs et des clients</h1>
		<h2>Rechercher des :</h2>
		<button onclick="AffServ()">Serveurs</button>
		<button onclick="AffCli()">Clients</button>
		<button onclick="AffLocs()">Locations</button>
		<input onchange="Actif()" value="actif" type="checkbox" id="activation"/>
		<label for="activation" id="labactiv"></label>

	</div>

	<div id="addServ" hidden>
	<form action='funcs/ajout-serv.php' method='POST'>
		<select name="type">
			<option value="JEU">Serveur de jeu</option>
			<option value="STOCKAGE">Serveur de stockage</option>
			<option value="WEB">Serveur web</option>
		</select>
		<select name="cpu">
			<option value="8">8 coeurs</option>
			<option value="16">16 coeurs</option>
			<option value="32">32 coeurs</option>
		</select>
		<select name="ram">
			<option value="32">32 Go</option>
			<option value="128">128 Go</option>
			<option value="256">256 Go</option>
		</select>
		<input type="text" name="stockage" placeholder="Volume de stockage" required/>
		<input type="submit" value="Ajouter"/>
	</form>
	</div>

	<?php
	if (isset($_GET["err"])) {
		switch ($_GET["err"]) {
			case "stock";
				echo "<h1 class='erreur'>Le stockage n'est pas conforme</h1>";
			break;
		}
	}
	?>

	<div id="table"></div>

<script>
<?php
tableau($db, "SELECT ID, Type, Cpu, Ram, Stockage, idLocation,  EnService FROM `serveurs` ORDER BY id DESC", "serv");
tableau($db, "SELECT ID, Email, Nom, Prenom, Actif FROM `clients` WHERE email != 'admin' ORDER BY id DESC", "clients");
tableau($db, "SELECT ID, IDclient, IDserveur, DebutLoc, FinLoc FROM `locations` ORDER BY id DESC", "locs");
?>
serv.header.push("Action");
serv.row.forEach(val => {
	if (val[6] == 1) {
		let id = val[0];
		let click = "<span onclick='Suppr("+id+")' style='cursor: pointer;'>Supprimer</span>";
		val.push(click);
	} else {
		let click = "<span style='color: grey;'>Supprimer</span>";
		val.push(click);
	}
});

locs.header.push("Action");
locs.row.forEach(val => {
	if (val[4] == "") {
		let id = val[0];
		let click = "<span onclick='Term("+id+")' style='cursor: pointer;'>Terminer</span>";
		val.push(click);
	} else {
		let click = "<span style='color: grey;'>Terminer</span>";
		val.push(click);
	}
});

clients.header.push("Action");
clients.row.forEach(val => {
	if (val[4] == "1") {
		let id = val[0];
		let click = "<span onclick='Close("+id+")' style='cursor: pointer;'>Supprimer</span>";
		val.push(click);
	} else {
		let click = "<span style='color: grey;'>Supprimer</span>";
		val.push(click);
	}
});

function Close(id) {
	let val = document.createElement("input");
	val.type = "hidden";
	val.name = "client";
	val.value = id;
	let form = document.createElement("form");
	form.method = "POST";
	form.action = "funcs/suppr-client.php";
	form.appendChild(val);
	document.body.appendChild(form);
	form.submit();
}

function Term(id) {
	let val = document.createElement("input");
	val.type = "hidden";
	val.name = "loc";
	val.value = id;
	let form = document.createElement("form");
	form.method = "POST";
	form.action = "funcs/term-loc.php";
	form.appendChild(val);
	document.body.appendChild(form);
	form.submit();
}

function Suppr(id) {
	let val = document.createElement("input");
	val.type = "hidden";
	val.name = "serv";
	val.value = id;
	let form = document.createElement("form");
	form.method = "POST";
	form.action = "funcs/suppr-serv.php";
	form.appendChild(val);
	document.body.appendChild(form);
	form.submit();
}

function Actif() {
	newTable = {};
	var index = 0;
	document.getElementById("table").innerHTML = "";

	switch (state) {
		case "":
			return;
			break;
		case "locs":
			newTable = JSON.parse(JSON.stringify(locs));
			var oldTable = locs;
			index = 4;
			var condition = "";
			break;
		case "serv":
			newTable = JSON.parse(JSON.stringify(serv));
			var oldTable = serv;
			index = 6;
			var condition = 1;
			break;
		case "clients":
			newTable = JSON.parse(JSON.stringify(clients));
			var oldTable = clients;
			index = 4;
			var condition = 1;
			break;
	}

	if (document.getElementById("activation").checked) {
		let len = newTable.row.length;
		let temp = [];
		for (let i = 0; i < len; i++) {
			if (newTable.row[i][index] == condition) {
				temp.push(newTable.row[i]);
			}
		}
		delete newTable.row;
		newTable.row = temp;
		Table(newTable, newTable);
	} else {
		Table(oldTable, oldTable);
	}
}

function AffLocs() {
	document.getElementById("addServ").hidden = true;
	document.getElementById("table").innerHTML = "";
	document.getElementById("labactiv").innerHTML = "Afficher seulement les locations en cours";
	state = "locs";
	if (document.getElementById("activation").checked) {
		Actif(locs);
	} else {
		Table(locs, locs);
	}
}

function AffServ() {
	document.getElementById("table").innerHTML = "";
	document.getElementById("labactiv").innerHTML = "Afficher seulement les serveurs en services";
	document.getElementById("addServ").hidden = false;
	state = "serv";
	if (document.getElementById("activation").checked) {
		Actif(serv);
	} else {
		Table(serv, serv);
	}
}

function AffCli() {
	document.getElementById("addServ").hidden = true;
	document.getElementById("table").innerHTML = "";
	document.getElementById("labactiv").innerHTML = "Afficher seulement les clients actifs";
	state = "clients";
	if (document.getElementById("activation").checked) {
		Actif(clients);
	} else {
		Table(clients, clients);
	}
}

<?php
if (isset($_GET["table"])) {
	switch ($_GET["table"]) {
		case "clients";
			echo "\nAffCli();";
		break;
		case "serv";
			echo "\nAffServ();";
		break;
		case "locs";
			echo "\nAffLocs();";
		break;
	}
} else {
	echo "\nAffServ();";
}
?>
</script>







</body>



<footer>
	<p>RT1 builded and &#128011 Powered.</p>
</footer>



</html>
