<?php 
   
   require_once 'config.php'; // ajout connexion bdd
   @include 'connexion.php';
   


  // si la session existe pas soit si l'on est pas connecté on redirige
   if(!isset($_SESSION['user'])){
       header('Location:index.php');
       die();
   }
  $id = $_SESSION["user"]["id"];
 $page = 2;
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Gestion devis/factures</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style/cubes.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">



</head>
  <body>

  

<?php 
include_once 'includes/navbar.php';
?>
<div style='padding:50px;'>
<br>
<br>

<!-- gestion des erreurs -->

<?php 

// ERREUR DE SUPPRESSION
                if(isset($_GET['delete_err']))
                {
                    $err = htmlspecialchars($_GET['delete_err']);

                    switch($err)
                    {
                       
                        case 'superadmin':
                        ?>
                            <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation"></i> <strong> Erreur !</strong> Impossible de supprimer le super admin
                            </div>
                        <?php
                        break;

                        case 'count':
                        ?>
                            <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation"></i> <strong> Erreur !</strong> Minimum de 2 admins
                            </div>
                        <?php
                        break;

                        case 'success':
                          ?>
                              <div class="alert alert-success">
                              <i class="fa-solid fa-circle-check"></i><strong> Validé !</strong> Suppression effectuée
                              </div>
                          <?php
                          break;
                      }
                    }


//ERREUR DE CHANGEMENT DE NIVEAU 

if(isset($_GET['update_err']))
                {
                    $err = htmlspecialchars($_GET['update_err']);

                    switch($err)
                    {
                       
                        case 'superadminUpdate':
                        ?>
                            <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation"></i> <strong> Erreur !</strong> Impossible de changer le niveau du super admin !
                            </div>
                        <?php
                        break;

                        case 'nivMax':
                        ?>
                            <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation"></i> <strong> Erreur !</strong> Niveau maximum d'administration
                            </div>
                        <?php
                        break;

                        case 'nivMin':
                          ?>
                              <div class="alert alert-danger">
                              <i class="fa-solid fa-circle-exclamation"></i> <strong> Erreur !</strong> Niveau minimum d'administration
                              </div>
                          <?php
                          break;

                        case 'successUpdate':
                          ?>
                              <div class="alert alert-success">
                              <i class="fa-solid fa-circle-check"></i><strong> Validé !</strong> Changement du niveau d'administration effectué
                              </div>
                          <?php
                          break;
                      }
                    }
                    ?> 

<div class="section1">
<?php
//si la personne connecter est un admin
if($_SESSION["user"]["role"] == "admin"){
$check_devis = $bdd->query("SELECT COUNT(DEV_ID_DEVIS) as count FROM T_D_DEVIS_DEV")->fetch()[0];
$check_facture = $bdd->query("SELECT COUNT(FACTURE_ID_FAC) as count FROM T_D_FACTURE_FAC")->fetch()[0];
}
// si la personne connecter est un client
if($_SESSION["user"]["role"] == "user"){
  $check_devis = $bdd->query("SELECT COUNT(DEV_ID_DEVIS) as count FROM T_D_DEVIS_DEV WHERE CLIENT_ID_CLT = $id")->fetch()[0];
  $check_facture = $bdd->query("SELECT COUNT(FACTURE_ID_FAC) as count FROM T_D_FACTURE_FAC WHERE DEVIS_ID_DEV = $id")->fetch()[0];
  }
//TABLEAU DES DEVIS
  $output = '';
  if($check_devis > 0){
    if($_SESSION["user"]["role"] == "admin"){
    $devis = $bdd->query('SELECT * FROM T_D_DEVIS_DEV ORDER BY DEV_ID_DEVIS');
  }
  if($_SESSION["user"]["role"] == "user"){
    $devis = $bdd->query("SELECT * FROM T_D_DEVIS_DEV WHERE CLIENT_ID_CLT = $id ORDER BY DEV_ID_DEVIS");
  }
      $output .= "
      <br>
      <br>
      <div class='col-lg-12'>
          <h2 class='title-1 m-b-25'><i class=\"fa-solid fa-file text-primary\"></i> Gestion des devis</h2>
          <div class='table-responsive table--no-card m-b-40'>
              <table class='table table-borderless table-striped table-earning'>
  <thead>
     <tr>
      <th scope=\"col\">ID</th>
      <th scope=\"col\">Date devis</th>
      <th scope=\"col\">Nom Client</th>
      <th scope=\"col\">Prix</th>
      <th scope=\"col\">TVA</th>
      <th scope=\"col\">Total</th>
      <th scope=\"col\">Statut</th>
      <th scope=\"col\">Actions</th>
    </tr>
</thead>
<tbody>
      ";

      foreach($devis as $dev){
        $total = $dev["DEV_TOTAL_DEVIS"]*1.2;
              $output .= "
              
              <tr>
              <th scope=\"row\">$dev[DEV_ID_DEVIS]</th>
              <td>$dev[DEV_DATEDEV_DEVIS]</td>
              <td>$dev[CLIENT_ID_CLT]</td>
              <td>$dev[DEV_TOTAL_DEVIS] €</td>
              <td>20%</td>
              <td>$total €</td>
              <td>$dev[DEV_STATUS_DEVIS]</td>
              
             
              
              
              <td>
              <a href=\"#\" data-id=\"$dev[CLIENT_ID_CLT]\" class=\"text-primary me-2 editBtn\" title=\"Modifier\"><i class=\"fa-solid fa-circle-info text-info\" data-bs-toggle=\"modal\" data-bs-target=\"#infoModal$dev[CLIENT_ID_CLT]\"></i></a>
              <i  type=\"button\" class=\"fas fa-trash-alt text-danger\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteClient$dev[CLIENT_ID_CLT]\"></i>
             </td>
            </tr>
           
            <div class=\"modal\" tabindex=\"-1\" id=\"deleteClient$dev[CLIENT_ID_CLT]\" role=\"dialog\">
            <div class=\"modal-dialog\">
              <div class=\"modal-content\">

                <div class=\"modal-body\">
                  <p> Etes vous sur de vouloir supprimer ce membre ? <p>
                </div>
                <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Annuler</button>
                <a href=\"delete.php?id=$dev[CLIENT_ID_CLT]\"><button class=\"btn btn-danger\" type=\"button\">Confirmer</button></a>
                </div>
              </div>
            </div>
          </div>

         
             "; 
      }

      $output .= "</tbody></table></div></div>";
      echo $output;
  }else{
      $output .= "<div class=\"text-center\"><br><h3 >Aucun devis pour le moment...</h3></div>";
      echo $output;
  }

  //TABLEAU DES FACTURES

  $output = '';
  if($check_facture > 0){
    if($_SESSION['user']["role"]== 'admin'){
    $factures = $bdd->query('SELECT * FROM T_D_FACTURE_FAC ORDER BY FACTURE_ID_FAC');
  }
  
      $output .= "
    
      <div class='col-lg-12'>
          <div style=\" display:flex; justify-content: space-between;\">
          <h2 class='title-1 m-b-25'><i class=\"fa-solid fa-dollar-sign text-warning\"></i> Gestion des factures</h2>
          </div>
       
          <br>
          <div class='table-responsive overview-item overview-item--c2 au-card-top-countries m-b-40'>
              <table class='table table-borderless text-light'>
  <thead>
     <tr style=\"border-bottom:solid 2px white\">
      <th scope=\"col\">ID</th>
      <th scope=\"col\">Date</th>
      <th scope=\"col\">Nom client</th>
      <th scope=\"col\">Total</th>
      <th scope=\"col\">Status</th>
      <th scope=\"col\">Actions</th>
    </tr>
</thead>
<tbody>


  </div>
</div>
</div>


      ";

      foreach($factures as $facture){
       

        $output .= "
              
        <tr>
        <th scope=\"row\">$facture[FACTURE_ID_FAC]</th>
        <td>$facture[FACTURE_DATE_FAC]</td>
        <td></td>
        <td></td>
        <td>$facture[FACTURE_STATUS_FAC]</td>
     
        
     
        
       
        </div>
      </div>
    </div>

   
       "; 
}

      

      $output .= "</tbody></table></div></div>";
      echo $output;
  }else{
      $output .= "<div class=\"text-center\"><br><h3 >Aucunes factures pour le moment...</h3></div>";
      echo $output;
  }

?>   
  </div>
  </div>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  </body>
</html>