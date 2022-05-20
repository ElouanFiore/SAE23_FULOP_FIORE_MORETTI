<?php
function tableau($data) {
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
}
?>
