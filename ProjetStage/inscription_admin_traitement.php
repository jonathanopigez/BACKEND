<?php
require_once 'config.php'; // On inclu la connexion à la bdd


// Si les variables existent et qu'elles ne sont pas vides
if(isset($_POST['admin_email']) && isset($_POST["admin_password"]) && isset($_POST["admin_password_retype"]))
{

     // Empeche faille XSS
    $admin_nom = htmlspecialchars($_POST['admin_nom']);
    $admin_prenom = htmlspecialchars($_POST['admin_prenom']);
    $admin_email = htmlspecialchars($_POST['admin_email']);
    $admin_password = htmlspecialchars($_POST['admin_password']);
    $admin_password_retype = htmlspecialchars($_POST['admin_password_retype']);
    $type_administrateur = htmlspecialchars($_POST['type_administrateur']);
    


    // On vérifie si l'utilisateur existe dans la table admin et la table utilisateur
    $check = $bdd->prepare('SELECT ADMIN_EMAIL_ADM, ADMIN_MDP_ADM FROM T_D_ADMINISTRATEUR_ADM WHERE ADMIN_EMAIL_ADM = ?');
    $check->execute(array($admin_email));
    $data = $check->fetch();
    $row = $check->rowCount();
    $check2 = $bdd->prepare('SELECT CLIENT_EMAIL_CLT, CLIENT_MDP_CLT FROM T_D_CLIENT_CLT WHERE CLIENT_EMAIL_CLT = ?');
    $check2->execute(array($admin_email));
    $data2 = $check2->fetch();
    $row2 = $check2->rowCount();
    $admin_email = strtolower($admin_email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents

     // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
    if($row == 0 && $row2 == 0){
        if(strlen($admin_email)<=100){// On verifie que la longueur du mail <= 100

            if(filter_var($admin_email, FILTER_VALIDATE_EMAIL))// Si l'email est de la bonne forme
            {
                if($admin_password === $admin_password_retype){ // si les deux mdp saisis sont bon

                    // On hash le mot de passe avec sha256
                    $admin_password = hash("sha256", $admin_password);
                    
                      // On insère dans la base de données
                    $insert = $bdd->prepare('INSERT INTO T_D_ADMINISTRATEUR_ADM(
                        ADMIN_NOM_ADM, 
                        ADMIN_PRENOM_ADM, 
                        ADMIN_EMAIL_ADM,
                        ADMIN_MDP_ADM,
                        ADMIN_TYPE_ADM,
                        ADMIN_TOKEN_ADM)VALUE(:admin_nom, :admin_prenom, :admin_email, :admin_password, :type_administrateur, :admin_token)');
                    $insert->execute(array(
                            'admin_nom' => $admin_nom,
                            'admin_prenom' => $admin_prenom,
                            'admin_email' => $admin_email,
                            'admin_password' => $admin_password,
                            'type_administrateur' => $type_administrateur,
                            'admin_token' => bin2hex(openssl_random_pseudo_bytes(64))


                    ));
                    header("location:gestion_utilisateur.php?reg_err=success");
                    die();
                    

                }else header("location:inscription.php?reg_err=password");
            }else header("location:inscription.php?reg_err=email_length");
        }else header("location:inscription.php?reg_err=email_length");
    }else header("location:inscription.php?reg_err=already");
}
