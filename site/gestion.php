<?php
session_start();
if (isset($_SESSION["username"])) {
	echo "".$_SESSION["username"];
} else {
	header("Location: login.php?redirect=gestion.php");
}
?>
