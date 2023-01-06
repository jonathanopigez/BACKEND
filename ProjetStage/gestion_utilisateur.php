<?php 
   
   require_once 'config.php'; // ajout connexion bdd
   @include 'connexion.php';
   


  // si la session existe pas soit si l'on est pas connecté on redirige
   if(!isset($_SESSION['user'])){
       header('Location:index.php');
       die();
   }
   if($_SESSION['user']['role'] == "user"){
    header('Location:index.php');
       die();
   }
 $page = 3;
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Espace membre</title>
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
                    //ERREUR DE CHANGEMENT DE NIVEAU 

if(isset($_GET['reg_err']))
{
    $err = htmlspecialchars($_GET['reg_err']);

    switch($err)
    {
       

        case 'success':
          ?>
              <div class="alert alert-success">
              <i class="fa-solid fa-circle-check"></i><strong> Validé !</strong> Ajout de l'administrateur effectué avec succès
              </div>

          <?php
          break;
      }
    }
    ?> 
                  


<?php

$check_utilisateur = $bdd->query("SELECT COUNT(CLIENT_ID_CLT) as count FROM T_D_CLIENT_CLT")->fetch()[0];
$check_admin = $bdd->query("SELECT COUNT(ADMIN_ID_ADM) as count FROM T_D_ADMINISTRATEUR_ADM")->fetch()[0];


//TABLEAU DES CLIENTS
  $output = '';
  if($check_utilisateur > 0){
    $utilisateurs = $bdd->query('SELECT * FROM T_D_CLIENT_CLT ORDER BY CLIENT_ID_CLT');
      $output .= "
      <br>
      <br>
      <div class='col-lg-12'>
          <h2 class='title-1 m-b-25'><i class=\"fa-solid fa-users text-primary\"></i> Gestion des membres</h2>
          <div class='table-responsive table--no-card m-b-40'>
              <table class='table table-borderless table-striped table-earning'>
  <thead>
     <tr>
      <th scope=\"col\">ID</th>
      <th scope=\"col\">Nom</th>
      <th scope=\"col\">Prénom</th>
      <th scope=\"col\">Email</th>
      <th scope=\"col\">Pays</th>
      <th scope=\"col\">Adresse</th>
      <th scope=\"col\">Date d'inscription</th>
      <th scope=\"col\">Compte validé</th>
      <th scope=\"col\">Actions</th>
    </tr>
</thead>
<tbody>
      ";

      foreach($utilisateurs as $utilisateur){
        if($utilisateur["CLIENT_VALIDE_CLT"]==0){
          $compteUserValide = "<i class='fa-solid fa-circle-xmark' style='color:red'></i>";
        }
        if($utilisateur["CLIENT_VALIDE_CLT"]==1){
          $compteUserValide = "<i class='fa-solid fa-circle-check' style='color:green'></i>";
        }
              $output .= /*  */
              "
              
              <tr>
              <th scope=\"row\">$utilisateur[CLIENT_ID_CLT]</th>
              <td>$utilisateur[CLIENT_NOM_CLT]</td>
              <td>$utilisateur[CLIENT_PRENOM_CLT]</td>
              <td>$utilisateur[CLIENT_EMAIL_CLT]</td>
              <td>$utilisateur[CLIENT_PAYS_CLT]</td>
              <td>$utilisateur[CLIENT_ADRESS1_CLT]</td>
              <td>$utilisateur[CLIENT_DATE_INSCRIPTION_CLT]</td>
              <td class='text-center'>$compteUserValide</td>
              
              
              <td>
              <a class=\"me-2\" href=\"#\" data-id=\"$utilisateur[CLIENT_NOM_CLT]\" title=\"Modifier\"><i class=\"fa-solid fa-circle-info text-info\" data-bs-toggle=\"modal\" data-bs-target=\"#infoModal$utilisateur[CLIENT_ID_CLT]\"></i></a>
              <a class=\"me-2\"><i class=\"fa-solid fa-message text-primary\"></i><a>
              <i  onclick=\"deleteUser($utilisateur[CLIENT_ID_CLT])\" type=\"button\" class=\"fas fa-trash-alt text-danger\"></i>
             </td>
            </tr>
           
            <div class=\"modal\" tabindex=\"-1\" id=\"deleteClient$utilisateur[CLIENT_ID_CLT]\" role=\"dialog\">
            <div class=\"modal-dialog\">
              <div class=\"modal-content\">

                <div class=\"modal-body\">
                  <p> Etes vous sur de vouloir supprimer ce membre ? <p>
                </div>
                <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Annuler</button>
                <a href=\"fonctions/delete.php?id=$utilisateur[CLIENT_ID_CLT]\"><button class=\"btn btn-danger\" type=\"button\">Confirmer</button></a>
                </div>
              </div>
            </div>
          </div>

          <div class=\"modal\" tabindex=\"-1\" id=\"infoModal$utilisateur[CLIENT_ID_CLT]\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <div class=\"modal-content\">

              <div class=\"modal-body\">
              <h4 class=\"text-primary\">Identifiant utilisateur :  </h4> <p class=\"pb-1\">$utilisateur[CLIENT_ID_CLT]</p>
              <h4 class=\"text-primary\">Nom : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_NOM_CLT]</p>
              <h4 class=\"text-primary\">Prénom : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_PRENOM_CLT]</p>
              <h4 class=\"text-primary\">Email : </h4><p class=\"pb-1\">$utilisateur[CLIENT_EMAIL_CLT]</p>
              <h4 class=\"text-primary\">mobile : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_MOBILE_CLT]</p>
              <h4 class=\"text-primary\">Pays : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_PAYS_CLT]</p>
              <h4 class=\"text-primary\">Ville : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_VILLE_CLT]</p>
              <h4 class=\"text-primary\">Code postale : </h4><p class=\"pb-1\">$utilisateur[CLIENT_CODEPOSTALE_CLT]</p>
              <h4 class=\"text-primary\">Adresse : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_ADRESS1_CLT]</p>
              <h4 class=\"text-primary\">Date d'inscription : </h4> <p class=\"pb-1\">$utilisateur[CLIENT_DATE_INSCRIPTION_CLT]</p>
             
              </div>
              <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Annuler</button>
              
              </div>
            </div>
          </div>
        </div>
             "; 
      }

      $output .= "</tbody></table></div></div>";
      echo $output;
  }else{
      $output .= "<div class=\"text-center\"><br><h3 >Aucun membre pour le moment...</h3></div>";
      echo $output;
  }

  //TABLEAU DES ADMIN

  $output = '';
  if($check_admin > 0){
    $admins = $bdd->query('SELECT * FROM T_D_ADMINISTRATEUR_ADM ORDER BY ADMIN_ID_ADM');
    $idCrypt = 
      $output .= "
    
      <div class='col-lg-12'>
          <div style=\" display:flex; justify-content: space-between;\">
          <h2 class='title-1 m-b-25'><i class=\"fa-solid fa-crown text-warning\"></i> Gestion des administrateurs</h2>
          
          <button class=\"au-btn au-btn-icon au-btn--blue text-light\"data-bs-toggle=\"modal\" data-bs-target=\"#modalAddAdmin\">
          <i class=\"zmdi zmdi-plus\"></i>Ajouter</button>
          </div>
          <br>
          <div class='table-responsive overview-item bg-dark au-card-top-countries m-b-40'>
              <table class='table table-borderless text-light'>
  <thead>
     <tr style=\"border-bottom:solid 2px white\">
      <th scope=\"col\">ID</th>
      <th scope=\"col\">Nom</th>
      <th scope=\"col\">Niveau</th>
      <th class=\"text-center\"scope=\"col\">Compte valide</th>
      <th scope=\"col\">Actions</th>
    </tr>
</thead>
<tbody>

<div class=\"modal \" tabindex=\"-1\" id=\"modalAddAdmin\" role=\"dialog\">
<div class=\"modal-dialog\">
  <div class=\"modal-content\">

    <div class=\"modal-body p-4\">
   

    <form action=\"inscription_admin_traitement.php\" method=\"post\">
    <h2 class=\"text-center titre\">Ajouter un Administrateur</h2>
 
    <div class=\"\" id=\"identite\">     
    <div class=\"form-group\">
    <i class=\"fa-solid fa-user\"></i>
        <input type=\"text\" name=\"admin_nom\" class=\"form-control\" placeholder=\"Nom\" required=\"required\" autocomplete=\"off\">
    </div>
    <div class=\"form-group decale\">
        <input type=\"text\" name=\"admin_prenom\" class=\"form-control\" placeholder=\"Prénom\" required=\"required\" autocomplete=\"off\">
    </div>
    </div>  
    <div class=\"form-group\">
    <i class=\"fa-solid fa-at\"></i>
        <input type=\"email\" name=\"admin_email\" class=\"form-control\" placeholder=\"Email\" required=\"required\" autocomplete=\"off\">
    </div>
    <div class=\"form-group\">
    <i class=\"fa-solid fa-lock\"></i>
        <input type=\"password\" name=\"admin_password\" class=\"form-control\" placeholder=\"Mot de passe\" required=\"required\" autocomplete=\"off\">
    </div>
    <div class=\"form-group decale\">
        <input type=\"password\" name=\"admin_password_retype\" class=\"form-control\" placeholder=\"Re-tapez le mot de passe\" required=\"required\" autocomplete=\"off\">
    </div>
    <div class=\"form-group\">
    <i class=\"fa-solid fa-shield\"></i>
        <select name=\"type_administrateur\" id=\"type_admin\">
            <option value=\"3\">Niveau 3</option>
            <option value=\"2\">Niveau 2</option>
            <option value=\"1\">Niveau 1</option>
        </select>
    </div>
   
   
    <div class=\"modal-footer\">
        <button type=\"submit\" class=\"btn btn-primary btn-block\">Ajouter</button>
        <button type=\"button\" class=\"btn btn-danger btn-block\" data-bs-dismiss=\"modal\">Annuler</button>
    </div>   
</form>
</div>








  </div>
</div>
</div>


      ";

      foreach($admins as $admin){
     
        if($utilisateur["CLIENT_VALIDE_CLT"]==0){
          $compteAdminValide = "<i class='fa-solid fa-xmark' style='color:white'></i>";
        }
        if($utilisateur["CLIENT_VALIDE_CLT"]==1){
          $compteAdminValide = "<i class='fa-solid fa-check' style='color:white'></i>";
        }

              $output .= "
              
              <tr>
              <th scope=\"row\">$admin[ADMIN_ID_ADM]</th>
              <td>$admin[ADMIN_NOM_ADM] $admin[ADMIN_PRENOM_ADM]</td>
              <td><a href=\"fonctions/admin_niveau_moins.php?id=$admin[ADMIN_ID_ADM]\"><i class=\" btn text-light fa-solid fa-minus\"></i></a> $admin[ADMIN_TYPE_ADM]<a href=\"fonctions/admin_niveau_plus.php?id=$admin[ADMIN_ID_ADM]\"> <i class=\" text-light btn fa-solid fa-plus\"></i></a></td>
              <td class='text-center'>$compteAdminValide</td>
              <td>
              <i class=\"fa-solid fa-message-dots\"></i>
              <i  onclick=\"deleteAdmin($admin[ADMIN_ID_ADM])\" type=\"button\" class=\"fas fa-trash-alt\"></i>
             </td>
            </tr>
         
           
             "; 
      }

      

      $output .= "</tbody></table></div></div>";
      echo $output;
  }else{
      $output .= "<div class=\"text-center\"><br><h3 >Aucun admin pour le moment...</h3></div>";
      echo $output;
  }

?>   
  </div>
  <script>






  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
  <script src="js/alert.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  </body>
</html>