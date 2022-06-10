<?php
try {
	$db = new PDO("mysql:host=localhost;charset=utf8;dbname=db_FIORE", "22104714", "Elouan");
} catch (Exception $e) {
	printf("ERREUR : %s\n", $e->getMessage());
}
?>
