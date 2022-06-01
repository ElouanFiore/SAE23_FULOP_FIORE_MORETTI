<?php
function tableau($db, $query) {
	$stmt = $db->query($query);
	$data = $stmt->fetchAll();
	$stmt->closeCursor();

	if (count($data) > 0) {
		$table = "var table = {header:[";
		foreach(array_keys($data[0]) as $i=>$key) {
			if (is_string($key)) {
				$table = $table."\"".$key." \\u2796\",";
			}
		}
		$table = $table."],row:[";
		foreach($data as $i=>$row) {
			$table = $table."[";
			foreach ($row as $j=>$val) {
				if (is_string($j)) {
					$table = $table."\"".$val."\",";
				}
			}
			$table = $table."],";
		}
		$table = $table."]};";
	} else {
		$table = "var table = {};";
	}
	echo $table;
}
?>
