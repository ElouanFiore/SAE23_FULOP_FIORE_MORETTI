<?php
session_start();
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
	<?php
	// if(isset($_SESSION(['username']) && $_SESSION['username']==='admin'){
	//   echo"<link rel="stylesheet" href="css/style2.css" media="screen" type="text/css" />";
	// }
	//  else {
	//	  echo"<link rel="stylesheet" href="css/404.css" media="screen" type="text/css" />";
	//   }
	?>
	<link rel="stylesheet" href="css/style2.css" media="screen" type="text/css" />
 	<script src="funcs/func-tableau.js"></script>
</head>

<nav>

	<div class="onglets">
		<a href="index.php">🏠 Accueil</a>
	</div>

</nav>

<body>
	<div class="gestion">
		<h1>Pannel de gestion et d'administration des serveurs et des clients</h1>
		<h2>Rechercher des :</h2>
		<button onclick="AffServ()">Serveurs</button>
		<button onclick="AffCli()">Clients</button>
		<button onclick="AffLocs()">Locations</button>
		<input onchange="Actif()" value="actif" type="checkbox" id="activation"/>

	</div>
	<div id="table"></div>

<script>
<?php
tableau($db, "SELECT ID, Type, Cpu, Ram, Stockage, idLocation,  EnService FROM `serveurs`", "serv");
tableau($db, "SELECT ID, Email, Nom, Prenom, Actif FROM `clients`", "clients");
tableau($db, "SELECT ID, IDclient, IDserveur, DebutLoc, FinLoc FROM `locations`", "locs");
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
	document.getElementById("table").innerHTML = "";
	state = "locs";
	Table(locs, locs);
}

function AffServ() {
	document.getElementById("table").innerHTML = "";
	state = "serv";
	Table(serv, serv);
}

function AffCli() {
	document.getElementById("table").innerHTML = "";
	state = "clients";
	Table(clients, clients);
}

var state = "serv";
Table(serv, serv);
</script>







</body>



<footer>
	<p>RT1 builded and &#128011 Powered.</p>
</footer>



</html>
