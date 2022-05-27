<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Multicast - Accueil</title>
	<link rel="stylesheet" href="css/style3.css">
	<script src="funcs/jquery-3.6.0.min.js"></script>
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
			if(isset($_SESSION['username']) && $_SESSION["nomPrenom"] == 'admin'){
				echo"<button class='admin'>Administration</button>";
				echo"<button class='deconnexion'>Se déconnecter</button>";
			} else if(isset($_SESSION['username'])) {
				$user = $_SESSION['nomPrenom'];
				echo"<button class='user'>$user</button>";
				echo"<button class='deconnexion'>Se déconnecter</button>";
			} else {
				printf("<button class='login'>S'authentifier</button>");
				printf("<button class='inscription'>Créer son compte</button>");
			};
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
	
<!-- Javascript, Jquery, je ne sais pas pourquoi ça ne fonctionne pas autrement	-->
<script>
//Script simple pour faire une redirection vers une autre page, remplace href
//Pour la page Login
$(document).ready(function(){
	$(".login").click(function(){
		if (this.innerHTML == "Se déconnecter") {
			window.location.href = "funcs/logout.php";
		} else {
			window.location.href = "login.php";
		}
	});
});
	
//Pour la page Inscription
$(document).ready(function(){
	$(".inscription").click(function(){
		window.location.href = "inscription.php";
	});
});

//Pour le bouton User
$(document).ready(function(){
	$(".user").click(function(){
		window.location.href = "compte.php";
	});
});

//Pour le bouton déconnexion
$(document).ready(function(){
	$(".deconnexion").click(function(){
		window.location.href = "funcs/logout.php";
	});
});

//Pour le bouton administration
$(document).ready(function(){
	$(".admin").click(function(){
		window.location.href = "admin.php";
	});
});


</script>
</body>

<!--The cloud is just someone else's computer-->
</html>
