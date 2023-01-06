<?php 
   
   require_once 'config.php'; // ajout connexion bdd
   @include 'connexion.php';

  // si la session existe pas soit si l'on est pas connecté on redirige
   if(!isset($_SESSION['user'])){
       header('Location:index.php');
       die();
   }
$progress = 0;
  
   
 
?>

<form action="" method="post" class="text-center"> 

  <div class="form-devis" id="formDevis">
  <h2 class="blue-color">Détails :</h2>
  <br>
  <br>
      <div id="divPrestation" class="gridDevis" style="display: flex;flex-direction:column;justify-content:center; align-items:center;">
        <div class="detail" style="display: flex;flex-direction:column; width:80%">
      <label class="blue-color" for="detail">Description :</label>
        <textarea class="form-control mb-3" name="detail"></textarea>
        <label class="blue-color" for="pieceJointe">Pièces jointes :</label>
        <input  type="file"></input>
  </div>
  </div>
  

     
    
      </form>

      <script src="js/devis.js"></script>