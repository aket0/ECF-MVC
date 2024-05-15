let ajouter = document.getElementById("ajout");
let roles = document.getElementById("role");

function removeInput() {
    this.parentElement.remove();
}

function ajoutRole(event) {
    console.log("coucou");
    const personnage = document.createElement("input")
    personnage.type = "text";
    personnage.name = "personnage[]";
    personnage.placeholder = "Personnage";
    personnage.className = "col-md-3";

    const nom = document.createElement("input")
    nom.type = "text";
    nom.name = "nom[]";
    nom.placeholder = "Nom";
    nom.className = "col-md-3";

    const prenom = document.createElement("input")
    prenom.type = "text";
    prenom.name = "prenom[]";
    prenom.placeholder = "Prenom";
    prenom.className = "col-md-3";


    const btn = document.createElement("input");
    btn.className = "col-md-2";
    btn.type = "button";
    btn.value = "supprimer";

    btn.addEventListener("click", removeInput);
    const flex = document.createElement("div");
    flex.className = "col";

    roles.appendChild(flex);
    flex.appendChild(personnage);
    flex.appendChild(nom);
    flex.appendChild(prenom);
    flex.appendChild(btn);
}

ajouter.addEventListener("click", ajoutRole);