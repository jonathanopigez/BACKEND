<?php 
require_once "../config.php";
// on vérifie le niveau de l'admin grace a son id
$checkNiveau = $bdd->query('SELECT ADMIN_TYPE_ADM FROM T_D_ADMINISTRATEUR_ADM WHERE ADMIN_ID_ADM = '.$_GET["id"].'');

 $responses = $checkNiveau->fetchAll();
// si son niveau est égal a 0 alors on renvoie l'érreur superadminUpdate
foreach($responses as $res){
    if($res['ADMIN_TYPE_ADM'] == 0){
         header("location:../gestion_utilisateur.php?update_err=superadminUpdate");
         die();
}
// si son niveau est égal a 3 alors on renvoie l'erreur nivMin
if($res['ADMIN_TYPE_ADM'] == 3){
    header("location:../gestion_utilisateur.php?update_err=nivMin");
    die();
}
// si son niveau est < à 3 alors on peut augmenter son niveau on met a jour avec un requête SQL puis on renvoie vers la pages gestion des utilsiateur
// avec l'erreur successUpdate.
if($res['ADMIN_TYPE_ADM'] < 3 ){
    
    $updateNiveau = $bdd->prepare('UPDATE T_D_ADMINISTRATEUR_ADM SET ADMIN_TYPE_ADM = ADMIN_TYPE_ADM +1 WHERE ADMIN_ID_ADM = '.$_GET["id"].'');
    $updateNiveau->execute();
    header("location:../gestion_utilisateur.php?update_err=successUpdate");
   
}

}
?>