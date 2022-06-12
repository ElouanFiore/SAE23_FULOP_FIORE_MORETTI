// Crée un tableau HTML à partir d'un dictionaire 
function Table(data, original) {
	let affiche = document.createElement("table");

	let ligne = document.createElement("tr");
	// Crée les Table Header qui servent aussi de bouton de tri
	data.header.forEach(header => {
		// Rend la colone triable sur click seulement si elle ne contient pas les boutons d'actions
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

// Fonction qui sert à trier une liste de liste
// retourne un nombre négatif ou positif pour que la fonction sort native sache comment ranger
function leTri(a, b) {
	let c = a - b;
	
	// si a et b en sont pas des nombre on utilise la fonction sort qui tri les chaine de caractère
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
	let sens = header.split(" ")[1]; // Récupère l'émojie pour connaitre dans quel sens trier
	let titre = header.split(" ")[0];
	let index = original.header.indexOf(titre+" \u2796"); // L'index selon lequel trier la table
	let sorted = JSON.parse(JSON.stringify(original)); // Créé un clone sans lien du dictionaire original

	document.getElementById("table").innerHTML = "";
	if (sens == "\u2B07") {
		// Tri le corp du tableau par ordre descendant 
		sorted.row.sort(function(a, b) {
			return leTri(b[index], a[index]);
		});
		sorted.header[index] = titre+" \u2B06";
		Table(sorted, original);
	} else if (sens == "\u2B06") {
		// Reprends le tableau original
		Table(sorted, original);
	} else {
		// Tri le corp du tableau par ordre ascendant
		sorted.row.sort(function(a, b) {
			return leTri(a[index], b[index]);
		});
		sorted.header[index] = titre+" \u2B07";
		Table(sorted, original);
	}
}