<?php
session_start();
if (isset($_SESSION["username"])) {
	header('Location: index.php');
	die();
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style2.css" media="screen" type="text/css" />
</head>
<body>
	<div id="logz">
		<?php
		if (isset($_GET["redirect"])) {
			printf("<form action='verification.php?redirect=%s' method='POST'>", $_GET["redirect"]);
		} else {
			echo "<form action='verification.php?redirect=index.php' method='POST'>";
		}
		?>
			<h1>Connexion</h1>
			<label><b>E-mail</b></label>
			<input type="text" placeholder="Entrer le votre e-mail" name="username" required>
			<label><b>Mot de passe</b></label>
			<input type="password" placeholder="Entrer le mot de passe" name="password" required>
			<input type="submit" id='submit' value='LOGIN' >
<?php
if (isset($_GET["wrong"])) {
	if ($_GET["wrong"] == 1) {
		echo "<h5 style='color: red;'>Mot de passe ou E-mail incorrect</h5>";
	}
}
?>
			<p>Multicast ~ Votre hébergeur</p>
		</form>
	</div>
</body>
</html>
