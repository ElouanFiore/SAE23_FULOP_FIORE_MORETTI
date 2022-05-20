<?php
require_once("connexion-base.php");
require_once("func-tableau.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
tableau($db, "SELECT * FROM clients");
?>
</body>
</html>
