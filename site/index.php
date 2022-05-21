<?php 
session_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Multicast - Accueil</title>
	<link rel="stylesheet" href="style3.css">
	<script src="script.js"></script>
	<script src="jquery-3.6.0.min.js"></script>
</head>

<body>
	<section class="page">
		<!-- Barre de Navigation t'as capté -->
		<nav>
			<div class="onglets">
				<a href="presentation.html">&#128203 Présentation du service</a>
				<a href="louer.php">&#128190 Louer son serveur</a>
				<a href="tarifs.html">&#128182 Tarifs</a>
				<a href="gestion.php">&#128187 ~@Panneau de configuration</a>
			</div>
			<div class="buttons">
			<?php
			if (isset($_SESSION["username"])) {
				printf("<p>%s</p>", $_SESSION['username']);
				echo "<a class='login' href='logout.php'>Se déconnecter</a>";
			} else {
				echo "<a class='login' href='login.php'>S'authentifier</a>";
				echo "<a class='inscription' href='inscription.php'>Créer son compte</a>";
			}
			?>
			</div>
		</nav>

		<header>
			<h1><b>Multicast,</br> votre hébergeur.</b> ☁️</h1>
		</header>

		<footer>
			<p>RT1 builded and &#128011 Powered.</p>
		</footer>
	</section>
 </div>
	
<!-- Javascript, Jquery, je ne sais pas pourquoi ça ne fonctionne pas autrement	
<script>
//Script simple pour faire une redirection vers une autre page, remplace href
//Pour la page Login
	$(document).ready(function(){
		$(".login").click(function(){
			console.log(window.location.href);
			window.location.href = "login.php";
		});
	});
	
//Pour la page Inscription
$(document).ready(function(){
		$(".inscription").click(function(){
			console.log(window.location.href);
			window.location.href = "inscription.php";
		});
	});
</script>
</body>
-->
<!--The cloud is just someone else's computer-->
</html>
