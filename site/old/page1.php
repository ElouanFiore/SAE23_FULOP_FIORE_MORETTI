<?php
function tableau($data) {
	printf("\t\t<tr>");
	foreach(array_keys($data[0]) as $i=>$key) {
		printf("<th>%s</th>", $key);
	}
	printf("<tr>\n");

	foreach($data as $i=>$row) {
		printf("\t\t<tr>");
		foreach ($row as $j=>$val) {
			printf("<td>%s</td>", $val);
		}
		printf("</tr>\n");
	}
}

try {
	$data = array();
	$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=db_FIORE", "22104714", "Elouan");
	$statement = $pdo->query("SELECT * FROM equipes");
	while($row=$statement->fetch(PDO::FETCH_ASSOC)) {
		$data[] = $row;
	}
	$statement->closeCursor();
	tableau($data);
} catch (Exception $e) {
	printf("ERREUR : %s\n", $e->getMessage());
}
echo </table>
?>
