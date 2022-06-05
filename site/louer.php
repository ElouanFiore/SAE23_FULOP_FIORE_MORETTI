<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Louer un serveur</title>
	<link rel="stylesheet" href="css/style3.css">
	<script src="funcs/jquery-3.6.0.min.js"></script>
</head>

<nav>

	<div class="onglets">
		<a href="index.php">🏠 Accueil</a>
	</div>

</nav>


<div id="loc">

	<h1> Espace location de serveur </h1>

</div>



<body>


	<select id="choix_type" onclick="choix_type()">
		<option value="--">Choix du type de serveur :</option>
		<option value="de jeu ! 🎮">Jeu 🎮</option>
		<option value="de stockage ! 💾">Stockage 💾</option>
		<option value="personnel ! 🖥️">Personnel 🖥️</option>
	</select>

	<select id="choix_cpu" onclick="cpu()">
		<option value="--">Choix puissance Cpu :</option>
		<option value="Cpu 1">Cpu 1</option>
		<option value="Cpu 2">Cpu 2</option>
		<option value="Cpu 3 ⚡">Cpu 3 ⚡</option>
	</select>

	<select id="choix_ram" onclick="ram()">
		<option value="--">-------</option>
		<option value="Ram 1">Ram 1</option>
		<option value="Ram 2">Ram 2</option>
		<option value="Ram 3⚡">Ram 3 ⚡</option>
	</select>

	<button onclick="choix()">Test</button>

	<h2>Ma commande :  <br>
	<div class="anim">

	   
		
			 <div id="type-f"></div> <br>
			 <div id="cpu-f"></div><br>
			 <div id="ram-f"></div>
		
		</h2>

	</div>




<script>
	function choix_type() {
		//Type
		var type = "Un serveur "+document.getElementById("choix_type").value;
		document.getElementById("type-f").innerText = type;
	}

	function cpu() {
		//Cpu
		var cpu = "Avec le CPU : "+document.getElementById("choix_cpu").value;
		document.getElementById("cpu-f").innerText = cpu;
	}

	function ram() {
		var ram = "Avec la RAM : "+document.getElementById("choix_ram").value;
		document.getElementById("ram-f").innerText = ram;
	}

	function choix() {
		console.log("Votre serveur sera de type : ", choix_type(), "\nDe cpu : ", cpu(), "\nDe ram : ", ram());
	}
</script>










</body>











<footer>



</footer>





</html>
