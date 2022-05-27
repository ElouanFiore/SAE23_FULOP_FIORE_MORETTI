function Table(sql) {
	let table = document.createElement("table");

	let ligne = document.createElement("tr");
	sql.header.forEach(header => {
		let cellule = document.createElement("th");
		cellule.innerHTML = header;
		ligne.appendChild(cellule);	
	});
	table.appendChild(ligne);
	
	sql.row.forEach(row => {
		let ligne = document.createElement("tr");
		row.forEach(data => {
			let cellule = document.createElement("td");
			cellule.innerHTML = data;
			ligne.appendChild(cellule);	
		});
		table.appendChild(ligne);
	});
	document.getElementById("table").appendChild(table);
}
