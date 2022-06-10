function Table(data, original) {
	let affiche = document.createElement("table");

	let ligne = document.createElement("tr");
	data.header.forEach(header => {
		let cellule = document.createElement("th");
		if (header != "Action") {
			cellule.onclick = function() {
				Tri(this.innerHTML, original);
			};
		}
		cellule.innerHTML = header;
		ligne.appendChild(cellule);	
	});
	affiche.appendChild(ligne);
	
	data.row.forEach(row => {
		let ligne = document.createElement("tr");
		row.forEach(data => {
			let cellule = document.createElement("td");
			cellule.innerHTML = data;
			ligne.appendChild(cellule);	
		});
		affiche.appendChild(ligne);
	});
	document.getElementById("table").appendChild(affiche);
}

function leTri(a, b) {
	let c = a - b;
	
	if (isNaN(c)) {
		c = [a, b];
		c.sort();
		let indexa = c.indexOf(a);
		let indexb = c.indexOf(b);
		if (indexa < indexb) {
			return -1;
		} else {
			return 1;
		}
	} else {
		return c;
	}
};

function Tri(header, original) {
	let sens = header.split(" ")[1];
	let titre = header.split(" ")[0];
	let index = original.header.indexOf(titre+" \u2796");
	let sorted = JSON.parse(JSON.stringify(original));

	document.getElementById("table").innerHTML = "";
	if (sens == "\u2B07") {
		sorted.row.sort(function(a, b) {
			return leTri(b[index], a[index]);
		});
		sorted.header[index] = titre+" \u2B06";
		Table(sorted, original);
	} else if (sens == "\u2B06") {
		Table(sorted, original);
	} else {
		sorted.row.sort(function(a, b) {
			return leTri(a[index], b[index]);
		});
		sorted.header[index] = titre+" \u2B07";
		Table(sorted, original);
	}
}

