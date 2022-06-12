<?php
// Détruit la session pour déconnetcer l'utilisateur
session_start();
session_destroy();
header('Location: /index.php');
die();
?>
