<?php 
   
   require_once 'config.php'; // ajout connexion bdd
   @include 'connexion.php';

  // si la session existe pas soit si l'on est pas connecté on redirige
   if(!isset($_SESSION['user'])){
       header('Location:index.php');
       die();
   }
$progress = 0;
  
   $checkOption = $bdd->query('SELECT count(PRESTATION_ID_PRS) as count FROM T_D_PRESTATION_PRS WHERE PRESTATION_TYPE_PRS = "Option"')->fetch()[0];
   $options = $bdd->query('SELECT * FROM T_D_PRESTATION_PRS WHERE PRESTATION_TYPE_PRS = "Option" ORDER BY PRESTATION_ID_PRS');
   
 
?>

<form action="" method="post" class="text-center"> 

  <div class="form-devis" id="formDevis">
  <h2 class="blue-color">Options :</h2>
  <br>
  <br>
      <div id="divPrestation" class="gridDevis">
      
      <?php
      $number = 0;
        if($checkOption > 0){
          $output = "";
          foreach($options as $option){
            $number = $number + 1;
              if($option["PRESTATION_TYPE_PRS"] == "Option" && $option["PRESTATION_SERVICE_PRS"] == 'integration'){
                  $output .= 
                    "<article class=\"option$number\">
                      <input type=\"checkbox\" class=\"radio\" name=\"option[1][]\"  id=\"feature$number \" data-type=\"$option[PRESTATION_SERVICE_PRS]\" data-prix=$option[PRESTATION_PRIX_PRS] />
                      <div>
                      <span>
                      $option[PRESTATION_NOM_PRS]
                      </span>
                      </div>
                      </article>"
                      ;
                }

          

}
        }
echo $output;
        ?>
  </div>
 
   
    
      </form>

      <script src="js/devis.js"></script>