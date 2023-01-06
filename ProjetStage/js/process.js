const flagDiv = document.getElementById("flagDiv");
const identite = document.getElementById("identite");
var createCard = document.createElement("div");
var createDiv = document.createElement("div");

// fonction au click sur le select qui va manipuler le dom et afficher les champs de formulaire en fonction de l'option selectionné.
$("#type_uti").click(function (event) {
  identite.innerHTML = "";
  var typeUtilisateur = event.target.options[event.target.selectedIndex].value;
  console.log(typeUtilisateur);
  // si le type d'utilisateur = 0 il correspond a particulier. donc on affiche les champ nom et prénom seulement.
  if (typeUtilisateur === "0") {
    createDiv.setAttribute("class", "form-group");
    createDiv.setAttribute("class", "column");
    createDiv.innerHTML =
      `
  <div class="form-group">` +
      `<i class="fa-solid fa-user">` +
      `</i>` +
      ` <input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">` +
      `</div>` +
      `<div class="form-group decale">` +
      `<input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off">` +
      `</div>`;
    identite.append(createDiv);
  }
  // si le type d'utilisateur = 1 il correspond a professionel donc on affiche les champ nom de l'entreprise ainsi que nom et prénom.
  if (typeUtilisateur === "1") {
    createDiv.setAttribute("class", "form-group");
    createDiv.setAttribute("class", "column");
    createDiv.innerHTML =
      `
    <div class="form-group">` +
      `<i class="fa-solid fa-building">` +
      `</i>` +
      `<input type="text" name="nom_entreprise" class="form-control" placeholder="Nom de l'entreprise" required="required" autocomplete="off">` +
      `</div>` +
      `<div class="form-group">` +
      `<i class="fa-solid fa-user">` +
      `</i>` +
      `<input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">` +
      `</div>` +
      `<div class="form-group decale">` +
      `<input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off">` +
      `</div>`;
    identite.append(createDiv);
  }
});

/* Une fonction qui est appelée lorsque l'utilisateur clique sur l'élément select avec l'id de pays. */
// fonction qui va afficher le drapeau correspodnant au pays cliquer.
$("#pays").click(function (event) {
  flagDiv.innerHTML = "";
  createCard.innerHTML = "";
  var svg = event.target.options[event.target.selectedIndex].id;
  var mobileCode =
    event.target.options[event.target.selectedIndex].dataset.code;
  console.log(svg);
  console.log(mobileCode);
  createCard.setAttribute("class", "flagdiv");
  createCard.innerHTML =
    `<img class=flagsvg src=images/flag/svg/` +
    svg +
    `.svg>` +
    `<h5>+` +
    mobileCode +
    `</h5>`;

  flagDiv.append(createCard);
});
