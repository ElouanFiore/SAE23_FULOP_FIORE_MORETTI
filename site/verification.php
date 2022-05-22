<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$db = new PDO("mysql:host=sql;charset=utf8;dbname=multicast", "root", "root");
	$stmt = $db->prepare("SELECT COUNT(id) FROM clients WHERE email=:u && mdp=SHA1(:p);");
	$stmt->execute(array("u"=>$username, "p"=>$password));
	$rows=$stmt->fetchAll();
	$stmt->closeCursor();
	
	if ($rows[0][0] == 1) {
		$_SESSION["username"]=$username;
		header('Location: '.$_GET["redirect"]);
		die();
	} else {
   		header('Location: login.php?wrong=1');
		die();
	}
} else {
	header('Location: login.php');
	die();
}
?>
