<?php
session_start(); // Démarrage de la session
require_once 'config.php'; // On inclut la connexion à la base de données

if(!empty($_POST['email']) && !empty($_POST['password'])) // Si les champs email et mot de passe ne sont pas vides
{
    // Patch XSS
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);
    $email = strtolower($email); // email transformé en minuscule

    // On regarde si l'utilisateur est inscrit dans la table utilisateurs
    $check_user = $bdd->prepare('SELECT * FROM T_D_CLIENT_CLT WHERE CLIENT_EMAIL_CLT = ?');
    $check_user->execute(array($email));
    $data_user = $check_user->fetch();
    $row_user = $check_user->rowCount();

    // On regarde si l'utilisateur est inscrit dans la table administrateur
    $check_admin = $bdd->prepare('SELECT * FROM T_D_ADMINISTRATEUR_ADM WHERE ADMIN_EMAIL_ADM = ?');
    $check_admin->execute(array($email));
    $data_admin = $check_admin->fetch();
    $row_admin = $check_admin->rowCount();
 

    
   
            // Si row > à 0 alors l'utilisateur existe dans la table utilisateur
            if($row_user > 0){

                     // Si le mail est bon niveau format
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {

                    // Si le mot de passe est le bon
                    $password = hash("sha256",$password);

                        if($data_user['CLIENT_MDP_CLT'] === $password){

                            // On créer la session et on redirige sur landing.php
                            $_SESSION['user'] = [
                                'id' => $data_user['CLIENT_ID_CLT'],
                                'nom' => $data_user['CLIENT_NOM_CLT'],
                                'prenom' => $data_user['CLIENT_PRENOM_CLT'],
                                'email' => $data_user['CLIENT_EMAIL_CLT'],
                                'token' => $data_user['CLIENT_TOKEN_CLT'],
                                'role' => "user"
                            ];
                            header('Location:landing.php');
                    


                        }else header('location:index.php?login_err=password');
                    }else header('location:index.php?login_err=email');
            };
            // Si row > à 0 alors l'utilisateur existe dans la table administrateur
            if($row_admin > 0){

                     // Si le mail est bon niveau format
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {

                    // Si le mot de passe est le bon
                    $password = hash("sha256",$password);
                  
                        if($data_admin['ADMIN_MDP_ADM'] === $password){

                            // On créer la session et on redirige sur landing.php
                            $_SESSION['user'] = [
                                'id' => $data_admin['ADMIN_ID_ADM'],
                                'nom' => $data_admin['ADMIN_NOM_ADM'],
                                'prenom' => $data_admin['ADMIN_PRENOM_ADM'],
                                'email' => $data_admin['ADMIN_EMAIL_ADM'],
                                'token' => $data_admin['ADMIN_TOKEN_ADM'],
                                'type' => $data_admin['ADMIN_TYPE_ADM'],
                                'role' => "admin"
                            ];
                            header('Location:landing.php');
           


                        }else header('location:index.php?login_err=password');
                    }else header('location:index.php?login_err=email');
            };
}
// else header("location:index.php"); 

// si le formulaire est envoyé sans aucune données