<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["nomPrenom"]);
header('Location: /index.php');
die();
?>
