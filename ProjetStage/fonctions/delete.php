<?php
require_once '../config.php'; // On inclu la connexion à la bdd
// si le role de l'utilisateur est "user" alors on le renvoie vers la page index.php et on met fin au script car un utilsiateur standard
// n'as pas l'autorisation de supprimé un admin ou un utilisateur.
if($_SESSION['user']['role'] == "user"){
    header('Location:../index.php');
       die();
   }
// on prépare la requête de suppression 
$req = $bdd->prepare("DELETE FROM T_D_CLIENT_CLT WHERE CLIENT_ID_CLT = :id");
// on envoie le paramètre id reçu dans le get pour cibler le bon utilisateur
$req -> bindParam(":id", $_GET["id"]);
// on execute la requête
$req->execute();
// on renvoi vers la page gestion des utilsiateurs avec l'erreur success
header("location:../gestion_utilisateur.php?delete_err=success");

?>
