let ajouter = document.getElementById("ajout");
let roles = document.getElementById("role");

//suppression des champs
function removeInput() {
    this.parentElement.remove();
}

//ajout d'un input
function addInput(element, text) {

    element.type = "text";
    element.name = text + "[]";
    element.placeholder = text;
    element.className = "col-md-3";
    element.required = true;
}


//ajout du champs role
function ajoutRole(event) {
    const personnage = document.createElement("input")
    const text = "personnage";
    addInput(personnage, text);

    const nom = document.createElement("input")
    const text_nom = "nom";
    addInput(nom, text_nom);

    const prenom = document.createElement("input")
    const text_prenom = "prenom";
    addInput(prenom, text_prenom);

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