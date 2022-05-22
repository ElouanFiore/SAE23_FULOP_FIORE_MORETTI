<?php
try {
	$db = new PDO("mysql:host=sql;charset=utf8;dbname=multicast", "root", "root");
} catch (Exception $e) {
	printf("ERREUR : %s\n", $e->getMessage());
}
?>
