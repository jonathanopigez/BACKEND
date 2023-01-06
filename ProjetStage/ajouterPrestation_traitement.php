<?php
require_once 'config.php'; // On inclu la connexion à la bdd

// Si les variables existent et qu'elles ne sont pas vides
if(isset($_POST['titrePrestation']) && isset($_POST["descriptionPrestation"]) && isset($_POST["prixPrestation"]))
{
   

     // Empeche faille XSS
     
    $titrePrestation = htmlspecialchars($_POST['titrePrestation']);
    $descriptionPrestation = htmlspecialchars($_POST['descriptionPrestation']);
    $prixPrestation = htmlspecialchars($_POST['prixPrestation']);
    $typePrestation = htmlspecialchars($_POST['type_prestation']);
    

    // On vérifie si la prestation existe deja dans la bdd
    $check = $bdd->prepare('SELECT PRODUIT_NOM_PRD FROM T_D_PRODUIT_PRD WHERE PRODUIT_NOM_PRD = ?');
    $check->execute(array($titrePrestation));
    $data = $check->fetch();
    $row = $check->rowCount();

     // Si la requete renvoie un 0 alors la prestation n'existe pas 
    if($row == 0){
       
                      // On insère dans la base de données
                    $insert = $bdd->prepare('INSERT INTO T_D_PRODUIT_PRD(
                        PRESTATION_NOM_PRS,
                        PRESTATION_DESCRIPTION_PRS,
                        PRESTATION_PRIX_PRS
                        PRESTATION_TYPE_PRS)VALUE(:titrePrestation, :descriptionPrestation, :prixPrestation, :type_prestation)');
                    $insert->execute(array(
                            'titrePrestation' => $titrePrestation,
                            'descriptionPrestation' => $descriptionPrestation,
                            'prixPrestation' => $prixPrestation,
                            'type_prestation' => $typePrestation
                         


                    ));
                    
                    // on met fin au script
                    die();
                    

        //sinon on renvoie vers la page landing avec l'erreur already      
    }else header("location:landing.php?prestation_err=already");
}
