<?php
session_start();
if (!isset($_SESSION["username"])) {
		header("Location: login.php?redirect=louer.php");
}

require("funcs/connexion-base.php");
require("funcs/func-tableau.php");

if (isset($_POST["type"]) && isset($_POST["ram"]) && isset($_POST["cpu"])) {
	$type = htmlspecialchars($_POST["type"]);
	$cpu = htmlspecialchars($_POST["cpu"]);
	$ram = htmlspecialchars($_POST["ram"]);
	$typeset = array("JEU", "WEB", "STOCKAGE");
	$cpuset = array("8", "16", "32");
	$ramset = array("32", "128", "256");
	
	if (in_array($type, $typeset) AND in_array($ram, $ramset) AND in_array($cpu, $cpuset)) {
		$sql = "SELECT * FROM ServeursDispo WHERE Type='$type' AND CPU >= $cpu AND RAM >= $ram";
	}
}
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

	<?php
	if (isset($sql)) {
		echo "<h1 class='info'>Type : $type / Nombre minimum de coeurs : $cpu / Quantitée minimal de RAM : $ram Go </h1>";
	}
	?>

	<div id="table"></div>

	<div class="anim">
		<div id="type-f"></div> <br>
		<div id="cpu-f"></div><br>
		<div id="ram-f"></div>
	</div>


	<script>
		// Affichage 

		<?php
		if (isset($sql)) {
			tableau($db, $sql, "servs");
		?>
		if (Object.keys(servs).length == 0) {
			document.getElementById("erreur").innerHTML = "Aucun serveurs avec ces spécifications n'est disponible";
		} else {
			servs.header.push("Action");
			servs.row.forEach(val => {
				let id = val[0];
				let click = "<span onclick='Reserver("+id+")' style='cursor: pointer;'>Louer</span>";
				val.push(click);
			});

			Table(servs, servs);
		}
		<?php
		}
		?>

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
					break;
				case "STOCKAGE":
					document.getElementById("type-f").innerText = "Un serveur de Stockage 💾";
					break;
				case "WEB":
					document.getElementById("type-f").innerText = "Un serveur Web ☁️";
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
					break;
				case "16":
					document.getElementById("cpu-f").innerText = "Avec le CPU 2 (16 coeurs)";
					break;
				case "32":
					document.getElementById("cpu-f").innerText = "Avec le CPU 3 ⚡ (32 coeurs)";
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
					break;
				case "128":
					document.getElementById("ram-f").innerText = "Avec 128 Go de RAM";
					break;
				case "256":
					document.getElementById("ram-f").innerText = "Avec 256 Go de RAM ⚡";
					break;
				case "--":
					document.getElementById("ram-f").innerText = "";
					break;
			}
		}

		function choix() {
			var type = document.getElementById("choix_type").value;
			var cpu = document.getElementById("choix_cpu").value;
			var ram = document.getElementById("choix_ram").value;

			if (type == "--" || cpu == "--" || ram == "--") {
				document.getElementById("erreur").innerHTML = "Veuillez séléctionner les spécifications minimales du serveurs";
			} else {
				document.getElementById("erreur").innerHTML = "";
				submit_post("louer.php", {type,cpu,ram});
			}
		}

		// Requête POST :
		function submit_post(url,para) {
			var formul = document.createElement("form");
			formul.method = "POST";
			formul.action = url;

			var input1 = document.createElement("input");
			input1.type = "hidden"; 
			input1.name = "type"; 
			input1.value = para["type"]; 
			formul.appendChild(input1); 

			var input2 = document.createElement("input"); 
			input2.type = "hidden";
			input2.name = "cpu";
			input2.value = para["cpu"];
			formul.appendChild(input2);

			var input3 = document.createElement("input"); 
			input3.type = "hidden";
			input3.name = "ram";
			input3.value = para["ram"];
			formul.appendChild(input3);

			document.body.appendChild(formul); 

			formul.submit(); // Soumission du formulaire
		}
	</script>

	<footer></footer>
</body>
</html>
