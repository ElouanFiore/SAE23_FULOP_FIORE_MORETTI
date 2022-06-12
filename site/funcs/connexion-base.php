<?php
// script utilisé pour toutes les interactions avec la bdd
try {
	$db = new PDO("mysql:host=sql;charset=utf8;dbname=multicast", "web", "zj%b6zube^&ajd");
} catch (Exception $e) {
	printf("ERREUR : %s\n", $e->getMessage());
}
?>
