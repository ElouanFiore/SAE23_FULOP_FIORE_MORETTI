<?php

// crée un dictionaire js ou un objet json à partir du contenu d'une bdd
function tableau($db, $query, $name) {
	$stmt = $db->query($query);
	$data = $stmt->fetchAll();
	$stmt->closeCursor();

	if ($name == "json") {
	// Création de l'objet json
		if (count($data) > 0) {
		// défini les headers
			$table = "{\"header\":[";
			$last = count($data[0]) - 2; // calcule l'index de la dernière clé à prendre en compte
			foreach(array_keys($data[0]) as $i=>$key) {
				if (is_string($key)) {
				// prend en compte seulement les clés qui sont des chaines de caractères
					if ($i < $last) { 
						$table = $table."\"".$key." \\u2796\",";
					} else {
					// si c'est la dernière clé on ferme la liste
						$table = $table."\"".$key." \\u2796\"],";
					}
				}
			}
			// défini les données lignes par lignes
			$table = $table."\"row\":[";
			$lastGlobal = count($data) - 1; // calcule l'index de la dernière ligne à prendre en compte
			foreach($data as $i=>$row) {
				$table = $table."[";
				$last = (count($row) - 2)/2; // calcule l'index de la dernière donnée à prendre en compte
				foreach ($row as $j=>$val) {
					if (is_string($j)) {
						$table = $table."\"".$val."\"";
					} else {
						if ($j == $last AND $i == $lastGlobal) {
						// si c'est la dernière donnée et la dernière ligne on ne met pas de virgule
							$table = $table."]";
						} else if ($j == $last) {
						// si c'est la dernière donnée on ferme la liste
							$table = $table."],";
						} else {
							$table = $table.",";
						}
					}
				}
			}
			$table = $table."]}";
		} else {
			// si le retour de la requête sql est vide on crée un dictionaire vide
			$table = "{}";
		}
		printf($table);
	} else {
		if (count($data) > 0) {
			// défini les headers
			$table = "var ".$name."  = {header:[";
			foreach(array_keys($data[0]) as $i=>$key) {
				if (is_string($key)) {
					$table = $table."\"".$key." \\u2796\",";
				}
			}
			// défini les données lignes par lignes
			$table = $table."],row:[";
			foreach($data as $i=>$row) {
				$table = $table."[";
				// défini les données d'une ligne
				foreach ($row as $j=>$val) {
					if (is_string($j)) {
						$table = $table."\"".$val."\",";
					}
				}
				$table = $table."],";
			}
			$table = $table."]};";
		} else {
			// si le retour de la requête sql est vide on crée un dictionaire vide
			$table = "var $name = {};";
		}
		echo $table;
	}
}
?>
