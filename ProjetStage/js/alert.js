function deleteAdmin(value) {
  console.log(value);
  Swal.fire({
    title: "Confirmer ?",
    showCloseButton: true,
    text: "Voulez vous vraiment supprimé cette administrateur ?",
    icon: "question",
    confirmButtonText:
      '<a class="text-light" href="fonctions/delete_admin.php?id=' +
      value +
      '">Confirmer</a>',
  });
}
function deleteUser(value) {
  console.log(value);
  Swal.fire({
    title: "Confirmer ?",
    showCloseButton: true,
    text: "Voulez vous vraiment supprimé cette utilisateur ?",
    icon: "question",
    confirmButtonText:
      '<a class="text-light" href="fonctions/delete.php?id=' +
      value +
      '">Confirmer</a>',
  });
}
