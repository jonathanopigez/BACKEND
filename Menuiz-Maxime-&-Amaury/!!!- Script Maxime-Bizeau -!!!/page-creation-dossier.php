<!-- Code de Maxime 30/06/2022 -->
<?php

require __DIR__ . '/Include/init.php';
require 'Model/ModelDossierSav.php';



@$createDoss = $_POST['createDoss'];
@$lastname = $_POST['lastname'];
@$firstname = $_POST['firstname'];
@$numCommande = $_POST['numCommande'];
@$email = $_POST['email'];
@$explication = $_POST['explication'];
@$usrid = $_SESSION['utilisateur']['id'];
@$savType = $_SESSION['savType'];

$prd_p = '';

if(isset($createDoss)){
    $createDossiers = new ModelDossierSAV();
    $createDossier = $createDossiers->InsertDossierSav($lastname, $firstname, 
    $numCommande, $email, $explication, $usrid);
}

// $typeSav = new ModelDossierSAV();
// $sav = $typeSav->RecupTypeSav()->fetchAll();

    

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ouvrir un ticket - Menuiz Man</title>
    <style>
        .creation{
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
    </style><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <?php include 'layout/top.php'; ?>
    <h1 class=> Un problème avec votre produit ?</h1>
    <h3> Remplissez-ce formulaire et nous vous aiderons !</h3>

    <div class="creation">
        <form method="post">


            <div class="form-group ligne">
                <label>Nom</label>
                <input type="text" name="lastname" value="<?= $lastname; ?>">
            </div>

            <div class="form-group ligne">
                <label>Prénom</label>
                <input type="text" name="firstname" value="<?= $firstname; ?>">
            </div>

            <div class="form-group ligne">
                <label>Numéro de commande</label>
                <input type="text" name="numCommande" value="<?= $numCommande; ?>">
            </div>

            <div class="form-group ligne">
                <label>Adresse Mail</label>
                <input type="text" name="email" value="<?= $email; ?>">
            </div>
            
            <!-- <div class="form-group">
                <label>Selection du type de SAV</label>
                <select name="savType" class="form-control">
                <option value=""></option>
            <?php
            foreach ($products as $prd) :
                $selected = ($prd['PRD_DESCRIPTION'] == $prd_p)
                    ? 'selected'
                    : '';
            ?>
                <option value="<?= $pdt['PRD_DESCRIPTION']; ?>" <?= $selected; ?>><?= $pdt['PRD_DESCRIPTION']; ?></option>
            <?php
            endforeach;
            ?>
                </select>
            </div> -->
            
            <div class="mb-3 ligne">
                <label for="exampleFormControlTextarea1" class="form-label">Explication problème/Quel produit ?</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="explication"></textarea>
            </div>



            <div class="form-group">
                <input class="btn btn-dark" type="submit" name="createDoss" value="Créer le ticket"/>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
<!-- Fin Code de Maxime 30/06/2022 -->