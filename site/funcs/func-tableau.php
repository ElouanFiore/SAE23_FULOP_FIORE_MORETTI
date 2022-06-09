<?php
function tableau($db, $query, $name) {
	$stmt = $db->query($query);
	$data = $stmt->fetchAll();
	$stmt->closeCursor();

	if ($name == "json") {
		if (count($data) > 0) {
			$table = "{\"header\":[";
			$last = count($data[0]) - 2;
			foreach(array_keys($data[0]) as $i=>$key) {
				if (is_string($key)) {
					if ($i < $last) { 
						$table = $table."\"".$key." \\u2796\",";
					} else {
						$table = $table."\"".$key." \\u2796\"],";
					}
				}
			}
			$table = $table."\"row\":[";
			$lastGlobal = count($data) - 1;
			foreach($data as $i=>$row) {
				$table = $table."[";
				$last = (count($row) - 2)/2;
				foreach ($row as $j=>$val) {
					if (is_string($j)) {
						$table = $table."\"".$val."\"";
					} else {
						if ($j == $last AND $i == $lastGlobal) {
							$table = $table."]";
						} else if ($j == $last) {
							$table = $table."],";
						} else {
							$table = $table.",";
						}
					}
				}
			}
			$table = $table."]}";
		} else {
			$table = "{}";
		}
		printf($table);
	} else {
		if (count($data) > 0) {
			$table = "var ".$name."  = {header:[";
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
			$table = "var $name = {};";
		}
		echo $table;
	}
}
?>
