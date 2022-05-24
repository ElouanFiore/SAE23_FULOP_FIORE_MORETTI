<html>

	<head>
	   <meta charset="utf-8">
	   <link rel="preconnect" href="https://fonts.googleapis.com">
	   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	   <link rel="stylesheet" href="css/style2.css" media="screen" type="text/css" />
	</head>

	
<body>
<nav>
<div class="onglets">
	<a href="index.php">🏠 Accueil</a>
</div>
</nav>

<div id="inscription">
	<?php
 	if (isset($_GET["redirect"])) {
		printf("<form action='funcs/verif-inscription.php?redirect=%s' method='POST'>", $_GET["redirect"]);
	} else {
		echo "<form action='funcs/verif-inscription.php?redirect=index.php' method='POST'>";
	}
	?>
	<h1>Inscription</br></h1>
	<h3>Bienvenue sur notre plateforme d'hébergement 😃</h3></br>

	<label><b>Nom :</b></label>
	<input type="text" placeholder="Entrez votre nom" name="nom" required>

	<label><b>Prénom :</b></label>
	<input type="text" placeholder="Entrez votre prénom" name="prenom" required>

	<label><b>E-mail :</b></label>
	<input type="email" placeholder="Entrez votre adresse e-mail" name="mail" required>

	<label><b>Mot de passe :</b></label>
	<input type="password" placeholder="Entrez votre mot de passe" name="pass" required>

	<label><b>Vérifiez votre mot de passe :</b></label>
	<input type="password" placeholder="Retapez votre mot de passe" name="pass2" required>

	<input type="submit" id='submit' value="S'inscrire">
	<?php
	if (isset($_GET["err"])) {
		switch($_GET["err"]) {
			case "email_long";
				echo "<h4 style='color: red;'>L'E-mail est trop long</h4>";
			break;
			case "nom_long";
				echo "<h4 style='color: red;'>Le nom est trop long</h4>";
			break;
			case "pre_long";
				echo "<h4 style='color: red;'>Le prénom est trop long</h4>";
			break;
			case "mdp";
				echo "<h4 style='color: red;'>Les mots de passe sont différents</h4>";
			break;
			case "existe";
				echo "<h4 style='color: red;'>L'utilisateur est déjà inscrit</h4>";
			break;
			case "email";
				echo "<h4 style='color: red;'>L'E-mail est invalide</h4>";
			break;

		}
	}
	?>
				
	<p>Multicast ~ Votre hébergeur</p>
			
	</form>
</div>
</body>
</html>
