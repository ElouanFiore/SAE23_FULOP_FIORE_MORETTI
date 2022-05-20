<?php
require_once("connexion-base.php");
require_once("func-tableau.php");
$stmt = $db->query("SELECT * FROM serveurs WHERE client=2");
$data = $stmt->fetchAll();
$stmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
if (count($data) > 0) {
    tableau($data);
} else {
    echo "<h1>IL Y A RIEN BATARD</h1>";
}
?>
</body>
</html>