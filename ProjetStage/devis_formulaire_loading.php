



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
<h2 class="blue-color">Estimation de votre devis...</h2>
  <div class="form-devis" id="formDevis">
  <div class="lds-ripple"><div></div><div></div></div>
</div>
</div>
  

     
    
      </form>
 
      <script src="js/devis.js"></script>