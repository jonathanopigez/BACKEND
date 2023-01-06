/**
 * Il crée un modal avec le framework SweetAlert2 qui contient un formulaire qui renvoie vers ajouterPrestation_traitement.php.
 */
function ajouterProduit() {
  Swal.fire({
    title: "Ajouter une prestation",
    showCloseButton: true,
    html: `<form action="ajouterPrestation_traitement.php" method="post">
    
 <div>
 <select name="type_prestation">
 <option value="prestation">Prestation</option>
 <option value="option">Option</option>
 
 </select>
<br>
<br>

        <input type="text" name="titrePrestation" class="form-control mb-3" placeholder="titre de la prestation" required="required" autocomplete="off">
 
        <input type="text" name="descriptionPrestation" class="form-control mb-3" placeholder="Description" required="required" autocomplete="off">
    
        <input type="text" name="prixPrestation" class="form-control mb-3" placeholder="prix" required="required" autocomplete="off">

        <button type="submit" class="btn btn-success onclick="success()">Ajouter</button>
        
   
</form>`,

    showConfirmButton: false,
  });
}

/**
 * Lorsque l'utilisateur clique sur le bouton, la fonction sera appelée et l'utilisateur sera alerté
 * par un message lui confirmant l'ajout de la prestation a la BDD.
 */
function success() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
  Toast.fire({
    icon: "success",
    title: "Prestation ajouter avec succès",
  });
}
