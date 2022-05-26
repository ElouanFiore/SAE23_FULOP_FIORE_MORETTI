<?php
session_start();
if (isset($_SESSION["username"])) {
	header('Location: index.php');
	die();
}
?>
<!DOCTYPE html>
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
<div id="logz">
	<?php
	if (isset($_GET["redirect"])) {
		printf("<form action='funcs/verif-connexion.php?redirect=%s' method='POST'>", $_GET["redirect"]);
	} else {
		echo "<form action='funcs/verif-connexion.php?redirect=index.php' method='POST'>";
	}
	?>

	<h1>Connexion</h1>

	<label><b>E-mail</b></label>
	<input type="email" placeholder="Entrer le votre e-mail" name="username" required>

	<label><b>Mot de passe</b></label>
	<input type="password" placeholder="Entrer le mot de passe" name="password" required>

	<input type="submit" id='submit' value="Se connecter">

	<?php
	if (isset($_GET["err"])) {
		switch($_GET["err"]) {
			case "inexistant";
				echo "<h4 style='color: red;'>Mot de passe ou E-mail incorrect</h4>";
			break;
			case "supprime";
				echo "<h4 style='color: red;'>Ce compte à été supprimé</h4>";
			break;
		}
	}

	if (isset($_GET["redirect"])) {
		printf("<p>Pas encore inscrit ? <a href='inscription.php?redirect=%s'>Cliquez ici.</a></p>", $_GET["redirect"]);
	} else {
		echo "<p>Pas encore inscrit ? <a href='inscription.php'>Cliquez ici.</a></p>";
	}
	?>
	
	<p>Multicast ~ Votre hébergeur</p>
	</form>
</div>
</body>
</html>
