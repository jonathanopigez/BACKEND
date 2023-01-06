// on initialise le total du devis a 0
var total = 0;

/**
 * Lorsque l'utilisateur clique sur le bouton, affiche une boîte de dialogue modale contenant un
 * formulaire. Le formulaire est chargé à partir d'un fichier séparé grâce a une requête ajax.
 * @param id - l'identifiant du client
 */
function creerDevis(id) {
  Swal.fire({
    title: "Creation de votre devis",
    showCloseButton: true,
    html: "<div id='divform'></div>",

    showConfirmButton: false,
  });
  $("#divform").load("devis_formulaire.php?id=" + id);
}

/**
 * La fonction prend un nombre comme argument, y ajoute 25, puis définit la largeur de la barre de
 * progression sur le nouveau nombre.
 * @param pourcentage - la progression actuelle de la barre de progression
 */
function progress(pourcentage) {
  const progressBar = $("#progressBar");
  pourcentage += 25;
  progressBar.attr("style", "width:" + pourcentage + "%").innerHTML;
}

// on selectionne tous les input de type checkbox
// on y ajoute un evenement au click
$("input:checkbox").on("click", function () {
  // l'élement clicker est stocker dans une variable
  var $box = $(this);
  if ($box.is(":checked")) {
    // on regroupe toutes les chekcbox portant le même nom dans une variable
    var group = 'input:checkbox[name="fooby[1][]"]';
    // l'état coché est récuperer
    //la valeur actuelle est récupérée à l'aide de la méthode .prop()
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

/* Une fonction qui est appelée lorsque le bouton avec l'identifiant "suivant" est cliqué. */
$("#next").click(function () {
  var choice = [];

  /* En parcourant toutes les cases cochées et en poussant l'attribut data-type vers le tableau de choix
et en définissant le total sur l'attribut data-prix. */
  $.each($("input:checkbox[name='fooby[1][]']:checked"), function () {
    choice.push($(this).attr("data-type"));
    total = $(this).attr("data-prix");
  });
  // si data-type = conception alors on appel devis_formulaire_conception.php avec la requête ajax
  if (choice.includes(" conception") === true) {
    $("#formDevis").fadeOut(1000);
    setTimeout(() => {
      $("#formDevis").load("devis_formulaire_conception.php");
    }, 1000);
    $("#formDevis").fadeIn(1000);
    console.log(total);
    $("#next").attr("onclick", "next2(" + total + ")");
  }
  // si data-type = integration alors on appel devis_formulaire_integration.php avec la requête ajax
  if (choice.includes(" integration") === true) {
    $("#formDevis").fadeOut(1000);
    setTimeout(() => {
      $("#formDevis").load("devis_formulaire_integration.php");
    }, 1000);
    $("#formDevis").fadeIn(1000);
    console.log(total);
    $("#next").attr("onclick", "next2(" + total + ")");
  }
  // si data-type = maintenance alors on appel devis_formulaire_maintenance.php avec la requête ajax
  if (choice.includes(" maintenance") === true) {
    $("#formDevis").fadeOut(1000);
    setTimeout(() => {
      $("#formDevis").load("devis_formulaire_maintenance.php");
    }, 1000);
    $("#formDevis").fadeIn(1000);
    console.log(total);
    $("#next").attr("onclick", "next2(" + total + ")");
  }
  // si data-type = maj alors on appel devis_formulaire_maj.php avec la requête ajax
  if (choice.includes(" maj") === true) {
    $("#formDevis").fadeOut(1000);
    setTimeout(() => {
      $("#formDevis").load("devis_formulaire_maj.php");
    }, 1000);
    $("#formDevis").fadeIn(1000);
    console.log(total);
    $("#next").attr("onclick", "next2(" + total + ")");
  }
});

/* Une fonction qui est appelée lorsque le bouton avec l'identifiant "suivant" est cliqué. */
/**
 * Il prend un nombre, l'ajoute au total, puis charge une nouvelle page dans la div et change
 * l'attribut onclick du bouton suivant en fonction suivante.
 * @param prix - le prix de l'option choisie
 */
function next2(prix) {
  console.log(prix);
  progress(25);
  total = prix;
  $.each($("input:checkbox[name='option[1][]']:checked"), function () {
    total = total + parseInt($(this).attr("data-prix"));
  });

  $("#formDevis").fadeOut(1000);
  setTimeout(() => {
    console.log(total);
    $("#formDevis").load("devis_formulaire_detail.php");
  }, 1000);
  $("#formDevis").fadeIn(1000);
  $("#next").attr("onclick", "next3(" + total + ")");
}

function next3(prix) {
  console.log(prix);
  progress(50);

  $("#formDevis").fadeOut(1000);
  setTimeout(() => {
    $("#formDevis").load("devis_formulaire_loading.php");
  }, 1000);
  $("#formDevis").fadeIn(1000);
  $("#formDevis").fadeOut(1000);
  setTimeout(() => {
    progress(75);

    $("#formDevis").html(
      '<div class="containerEstimation">' +
        '<span">Votre devis est estimé a :</span>' +
        '<span class="blue-color">' +
        prix +
        "€</span>" +
        "</div>"
    );

    $("#next").text("Terminer");
    $("#next").attr("type", "submit");
    $("#next").click(function () {
      $("#devis_formulaire").submit();
    });
  }, 4000);

  $("#formDevis").fadeIn(1000);
}
