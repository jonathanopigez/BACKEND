<?php
require __DIR__ .'/Include/init.php';
require 'Model/ModelDossierSav.php';
// require 'Include/fonctions.php';

// adminSecurity();

// // concat_ws(' ', u.prenom, u.nom) //concatenation valeur sql
// $query = 'SELECT C.*,U.USR_FIRSTNAME as user_name, U.USR_LASTNAME as user_prenom 
// FROM T_D_ORDERHEADER_OHR C 
// INNER JOIN T_D_USER_USR U ON C.USR_ID = U.USR_ID where U.USR_id= ' . $_SESSION['utilisateur']['id'];
// $stmt = $pdo->query($query);
// $commandes = $stmt->fetchAll();

@$recherche = $_POST['chercher'];

    $sqlwhere='';
    // Par Numéro de Commande
if(isset($recherche)){
    if(!empty($_POST['numero'])){
       $sqlwhere.=" OHR_NUMBER='".$_POST['numero']."' ";
    }

    // Par Numéro de Dossier
    if (!empty($_POST['numDossier'])){
        if (!empty($sqlwhere)){
            $sqlwhere .= " AND SAV_NUM_DOSSIER='".$_POST['numDossier']."'";
        }
        else{
            $sqlwhere .= " SAV_NUM_DOSSIER='".$_POST['numDossier']."'";
        }
    }

    // Par Login Web (Email)
    if(!empty($_POST['logWeb'])){
        if(!empty($sqlwhere)){
            $sqlwhere.= " AND USR_MAIL='".$_POST['logWeb']."'";
        }
        else{
            $sqlwhere.= " USR_MAIL='".$_POST['logWeb']."'";
        }
    }

    // Par Dénomination Client (Nom de famille)
    if(!empty($_POST['denClient'])){
        if(!empty($sqlwhere)){
            $sqlwhere.= " AND USR_LASTNAME='".$_POST['denClient']."'";
        }
        else{
            $sqlwhere.= " USR_LASTNAME='".$_POST['denClient']."'";
        }
    }
}
    $modeleDossierSav = new ModelDossierSAV();
    $dossierSav = $modeleDossierSav->AfficheDossierSAV($sqlwhere);


?>

    <!-- Code de Jonathan 28/06/2022 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .recherche{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
        }

        .ligne{
            display:flex;
            justify-content: space-between;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Fin du Code de Jonathan 28/06/2022 -->
<?php


require_once __DIR__ .'/layout/top.php';

?>


    <div class="recherche">
        <h1>Recherche</h1>
        <form method="post" action="">
            <div class="ligne">    
                <label for="numero">Numéro de commande</label>
                <input type="text" name="numero">
            </div>
            <div class="ligne">
                <label for="numDossier">Numéro de dossier</label>
                <input type="text" name="numDossier">
            </div>
            <div class="ligne"> 
                <label for="logWeb">Login Web (Email)</label>
                <input type="text" name="logWeb">
            </div>
            <div class="ligne">  
            <label for="denClient">Dénomination Client (Nom de famille)</label>
            <input type="text" name="denClient">
        </div>
     
        
         
            <div class="button">
                <input class="btn btn-dark" type="submit" name="chercher" value="Chercher"/>
                <button class="btn btn-dark" type="reset">RAZ</button>
            </div>
        </form>
    </div>
    <!-- Code de Maxime le 29/06/2022 -->
    <?php if(isset($recherche)):?>
    <div class="DossierFound">
        <div class="justify-self-center">
            <h1 class="">Dossier SAV :</h1>
        </div>

        <!-- le tableau HTML ici -->
        <table class="table_cat th_produits table table-striped table-dark">
            <tr>
                <th>N° Commande</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro de dossier</th>
                <th>Type SAV</th>
                <th>Date commande</th>
                

            </tr>
            <?php


            foreach ($dossierSav as $dossier) :
            
            ?>
                <tr>
                    <td><?= $dossier['OHR_NUMBER']; ?></td>
                    <td><?= $dossier['USR_LASTNAME']; ?></td>
                    <td><?= $dossier['USR_FIRSTNAME']; ?></td>
                    <td><?= $dossier['SAV_NUM_DOSSIER']; ?></td>
                    <td><?= $dossier['STY_DESCRIPTION']; ?></td>
                    <td><?= datetimeFR($dossier['OHR_DATE']); ?></td>

                    <td>
                        <a href="<?= RACINE_WEB; ?>detail-dossier-sav.php">Détails</a>
                    </td>


                </tr>

            <?php
            endforeach;
            ?>
        </table>
    </div>
    <?php endif ?>
    <!-- Fin Code de Maxime le 29/06/2022 -->
</body>
</html>
<?php

require_once __DIR__ .'/layout/bottom.php';
?>