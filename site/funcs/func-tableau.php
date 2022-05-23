<?php
function tableau($db, $query) {
	$stmt = $db->query($query);
	$data = $stmt->fetchAll();
	$stmt->closeCursor();
	
	if (count($data) > 0) {
		echo "<table>";
		foreach(array_keys($data[0]) as $i=>$key) {
			if (is_string($key)) {
				printf("<th>%s</th>", $key);
			}
		}
		foreach($data as $i=>$row) {
			echo "<tr>";
			foreach ($row as $j=>$val) {
				if (is_string($j)) {
					printf("<td>%s</td>", $val);
				}
			}
			echo "</tr>\n";
		}
		echo "</table>";
	} else {
	    echo "<h1>IL Y A RIEN BATARD</h1>";
	}
}
?>
