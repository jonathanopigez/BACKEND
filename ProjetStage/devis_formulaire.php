<?php 
   
   require_once 'config.php'; // ajout connexion bdd
   @include 'connexion.php';

  // si la session existe pas soit si l'on est pas connecté on redirige
   if(!isset($_SESSION['user'])){
       header('Location:index.php');
       die();
   }
$progress = 0;
   $checkPrestation = $bdd->query('SELECT count(PRESTATION_ID_PRS) as count FROM T_D_PRESTATION_PRS WHERE PRESTATION_TYPE_PRS = "Prestation"')->fetch()[0];
   $checkOption = $bdd->query('SELECT count(PRESTATION_ID_PRS) as count FROM T_D_PRESTATION_PRS WHERE PRESTATION_TYPE_PRS = "Option"')->fetch()[0];
   $prestations = $bdd->query('SELECT * FROM T_D_PRESTATION_PRS WHERE PRESTATION_TYPE_PRS = "Prestation" ORDER BY PRESTATION_ID_PRS');
   $options = $bdd->query('SELECT * FROM T_D_PRESTATION_PRS WHERE PRESTATION_TYPE_PRS = "Option" ORDER BY PRESTATION_ID_PRS');
   
 
?>

<form action="traitement_devis.php" method="post" class="text-center" id="devis_formulaire"> 
<div class="progress">
  <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow=<?php echo $progress;?> aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress;?>%"></div>
</div>

  <div class="form-devis" id="formDevis">
  <h2 class="blue-color">Prestations proposées :</h2>
  <br>
  <br>
      <div id="divPrestation" class="gridDevis">
      
        <?php 
          if($checkPrestation > 0){
              $number = 0;
              $output = '';
            foreach($prestations as $prestation){
              $number = $number + 1;
                if($prestation["PRESTATION_TYPE_PRS"] == "Prestation"){
                    $output .= 
                   
                    "<article class=\"prestation$number\">
                         <input type=\"checkbox\" class=\"radio\" name=\"fooby[1][]\" id=\"feature$number \" data-type=\" $prestation[PRESTATION_SERVICE_PRS]\" data-prix=$prestation[PRESTATION_PRIX_PRS] />
                         <div>
                        <span>
                                $prestation[PRESTATION_NOM_PRS]
                        </span>
                                        </div>
                        </article>";
                  }
              }
          }else{
            $output .= "<div class=\"text-center\"><br><h3 >aucune prestations pour le moment ...</h3></div>";
        };;
         
          echo $output;
?>
  </div>
  
</div>
</div>
     <br>
     <br>
      <div id="next" type="button" class="btn btn-info" onclick="progress(0)">Suivant</div> 
      </form>

      <script src="js/devis.js"></script>