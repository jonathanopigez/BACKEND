
<?php 
// Requête pour supprimé un admin
require_once "../config.php"; // on inclu la base de données
@include '../connexion.php'; // on inclu la connexion pour la vérification des droits

// si le role de l'utilisateur est "user" alors on le renvoie vers la page index.php et on met fin au script car un utilsiateur standard
// n'as pas l'autorisation de supprimé un admin
if($_SESSION['user']['role'] == "user"){
    header('Location:../index.php');
       die();
   }
// on vérifie le niveau de l'admin   
$checkNiveau = $bdd->query('SELECT ADMIN_TYPE_ADM FROM T_D_ADMINISTRATEUR_ADM WHERE ADMIN_ID_ADM = '.$_GET["id"].'');

$responses = $checkNiveau->fetchAll();
// on vérifie le nombre d'admin
 $check_admin = $bdd->query("SELECT COUNT(ADMIN_ID_ADM) as count FROM T_D_ADMINISTRATEUR_ADM")->fetch()[0];
 // on prépare la requête de suppression.
 $req = $bdd->prepare("DELETE FROM T_D_ADMINISTRATEUR_ADM WHERE ADMIN_ID_ADM = :id");
 // on envoie le paramètre id recue dans le get pour identifié quelle admin on souhaite supprimé.
 $req->bindParam(":id",$_GET["id"]);


/* En vérifiant si l'utilisateur est un super admin, si l'utilisateur est un super admin il redirigera
vers la page gestion_utilisateur.php avec l'erreur superadmin. Si l'utilisateur n'est pas un super
admin il vérifiera s'il y a plus de 2 admins, s'il y a moins de 2 admins il redirigera vers la page
gestion_utilisateur.php avec l'erreur count car il doit rester un minimum de 2 admin.
S'il y a plus de 2 admins et qu'il n'est pas le superAdmin alors il exécutera la requête
et redirigera vers la page gestion_utilisateur.php avec l'erreur success. */
foreach($responses as $res){
    if($res['ADMIN_TYPE_ADM'] == 0){
         header("location:../gestion_utilisateur.php?delete_err=superadmin");
         die();
}

if($check_admin <= 2){
    
    header("location:../gestion_utilisateur.php?delete_err=count");
    die();
}

if($res['ADMIN_TYPE_ADM'] != 0 && $check_admin >2){
    
     $req->execute();
     header("location:../gestion_utilisateur.php?delete_err=success");
     die();
}
}
?>