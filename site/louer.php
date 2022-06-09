<?php
session_start();
if (!isset($_SESSION["username"])) {
		header("Location: login.php?redirect=louer.php");
}
require("funcs/connexion-base.php");
require("funcs/func-tableau.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Louer un serveur</title>
	<link rel="stylesheet" href="css/style3.css">
	<script src="funcs/jquery-3.6.0.min.js"></script>
	<script src="funcs/func-tableau.js"></script>
</head>

<body>
	<nav>
		<div class="onglets">
			<a href="index.php">🏠 Accueil</a>
		</div>
	</nav>

	<div class="titre">
		<h1>Espace de location de serveurs</h1>
	</div>

	<div id="selection">
		<select id="choix_type" onchange="choix_type()">
			<option value="--">Type de serveur</option>
			<option value="JEU">Jeu</option>
			<option value="STOCKAGE">Stockage</option>
			<option value="WEB">Web</option>
		</select>

		<select id="choix_cpu" onchange="cpu()">
			<option value="--">Puissance du CPU</option>
			<option value="8">8 coeurs</option>
			<option value="16">16 coeurs</option>
			<option value="32">32 coeurs</option>
		</select>

		<select id="choix_ram" onchange="ram()">
			<option value="--">Quantitée de RAM</option>
			<option value="32">32 Go</option>
			<option value="128">128 Go</option>
			<option value="256">256 Go</option>
		</select>

		<button onclick="choix()">Je veux !</button>
	</div>
	
	<h1 id="erreur" class="info"></h1>

	<div id="table"></div>

	<div class="anim">
		<div id="type-f"></div> <br>
		<div id="cpu-f"></div><br>
		<div id="ram-f"></div>
	</div>


	<script>
		function Reserver(id) {
			var formul = document.createElement("form");
			formul.method = "POST";
			formul.action = "funcs/debut-loc.php";

			var input = document.createElement("input");
			input.type = "hidden"; 
			input.name = "id"; 
			input.value = id; 
			formul.appendChild(input); 
			document.body.appendChild(formul); 
			formul.submit(); // Soumission du formulaire
		}

		function choix_type() {
			//Type
			var type = document.getElementById("choix_type").value;
			switch (type) {
				case "JEU":
					document.getElementById("type-f").innerText = "Un serveur de Jeu 🎮";
					document.getElementById("table").innerHTML = "";
					break;
				case "STOCKAGE":
					document.getElementById("type-f").innerText = "Un serveur de Stockage 💾";
					document.getElementById("table").innerHTML = "";
					break;
				case "WEB":
					document.getElementById("type-f").innerText = "Un serveur Web ☁️";
					document.getElementById("table").innerHTML = "";
					break;
				case "--":
					document.getElementById("type-f").innerText = "";
					break;
			}
		}

		function cpu() {
			//Cpu
			var cpu = document.getElementById("choix_cpu").value;
			switch (cpu) {
				case "8":
					document.getElementById("cpu-f").innerText = "Avec le CPU 1 (8 coeurs)";
					document.getElementById("table").innerHTML = "";
					break;
				case "16":
					document.getElementById("cpu-f").innerText = "Avec le CPU 2 (16 coeurs)";
					document.getElementById("table").innerHTML = "";
					break;
				case "32":
					document.getElementById("cpu-f").innerText = "Avec le CPU 3 ⚡ (32 coeurs)";
					document.getElementById("table").innerHTML = "";
					break;
				case "--":
					document.getElementById("cpu-f").innerText = "";
					break;
			}
		}

		function ram() {
			var ram = document.getElementById("choix_ram").value;
			switch (ram) {
				case "32":
					document.getElementById("ram-f").innerText = "Avec 32 Go de RAM";
					document.getElementById("table").innerHTML = "";
					break;
				case "128":
					document.getElementById("ram-f").innerText = "Avec 128 Go de RAM";
					document.getElementById("table").innerHTML = "";
					break;
				case "256":
					document.getElementById("ram-f").innerText = "Avec 256 Go de RAM ⚡";
					document.getElementById("table").innerHTML = "";
					break;
				case "--":
					document.getElementById("ram-f").innerText = "";
					break;
			}
		}

		async function choix() {
			var type = document.getElementById("choix_type").value;
			var cpu = document.getElementById("choix_cpu").value;
			var ram = document.getElementById("choix_ram").value;

			if (type == "--" || cpu == "--" || ram == "--") {
				document.getElementById("erreur").innerHTML = "Veuillez séléctionner les spécifications minimales du serveurs";
			} else {
				let data = new FormData();
				data.append("type", type);
				data.append("cpu", cpu);
				data.append("ram", ram);
				let test = await fetch("funcs/aff-serv.php", {method: "POST", body: data});
				let servs = await test.json()
	
				if (Object.keys(servs).length == 0) {
					document.getElementById("erreur").innerHTML = "Aucun serveurs avec ces spécifications n'est disponible";
				} else {
					servs.header.push("Action");
					servs.row.forEach(val => {
						let id = val[0];
						let click = "<span onclick='Reserver("+id+")' style='cursor: pointer;'>Louer</span>";
						val.push(click);
					});

					document.getElementById("erreur").innerHTML = "";
					Table(servs, servs);
				}
			}
		}
	</script>

	<footer></footer>
</body>
</html>
