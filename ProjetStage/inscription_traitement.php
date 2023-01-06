<?php
require_once 'config.php'; // On inclu la connexion à la bdd



// Si les variables existent et qu'elles ne sont pas vides
if(isset($_POST['email']) && isset($_POST["password"]) && isset($_POST["password_retype"]))
{
    // on génère un nombre aléatoire a 6 chiffres pour le token
    $code = "";
                        for ($i=0; $i < 6 ; $i++) {
                          $code.=rand(0,9);
                        }

     // Empeche faille XSS
     
    $type_utilisateur = htmlspecialchars($_POST['typeUtilisateur']);
    $nom_entreprise = htmlspecialchars($_POST['nom_entreprise']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);
    $pays = htmlspecialchars($_POST['pays']);
    $ville = htmlspecialchars($_POST['ville']);
    $postale = htmlspecialchars($_POST['postale']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $mobile = htmlspecialchars($_POST['mobile']);


 
    // On vérifie si l'utilisateur existe dans la table admin et la table utilisateur
    $check = $bdd->prepare('SELECT CLIENT_EMAIL_CLT, CLIENT_MDP_CLT FROM T_D_CLIENT_CLT WHERE CLIENT_EMAIL_CLT = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();
    $check2 = $bdd->prepare('SELECT ADMIN_EMAIL_ADM, ADMIN_MDP_ADM FROM T_D_ADMINISTRATEUR_ADM WHERE ADMIN_EMAIL_ADM = ?');
    $check2->execute(array($email));
    $data2 = $check2->fetch();
    $row2 = $check2->rowCount();
    $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents

     // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
    if($row == 0 && $row2 == 0){
        if(strlen($email)<=100){// On verifie que la longueur du mail <= 100

            if(filter_var($email, FILTER_VALIDATE_EMAIL))// Si l'email est de la bonne forme
            {
                if($password === $password_retype){ // si les deux mdp saisis sont bon

                    // On hash le mot de passe avec sha256
                    $password = hash("sha256", $password);
                    
                      // On insère dans la base de données
                    $insert = $bdd->prepare('INSERT INTO T_D_CLIENT_CLT(
                        CLIENT_TYPE_CLT,
                        CLIENT_NOM_ENTREPRISE_CLT,
                        CLIENT_NOM_CLT, 
                        CLIENT_PRENOM_CLT, 
                        CLIENT_EMAIL_CLT,
                        CLIENT_MDP_CLT,
                        CLIENT_PAYS_CLT,
                        CLIENT_VILLE_CLT,
                        CLIENT_CODEPOSTALE_CLT,
                        CLIENT_ADRESS1_CLT,
                        CLIENT_MOBILE_CLT,
                        CLIENT_TOKEN_CLT)VALUE(:typeUtilisateur, :nom_entreprise, :nom, :prenom, :email, :password, :pays, :ville, :postale, :adresse, :mobile, :token)');
                    $insert->execute(array(
                            'typeUtilisateur' => $type_utilisateur,
                            'nom_entreprise' => $nom_entreprise,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'email' => $email,
                            'password' => $password,
                            'pays' => $pays,
                            'ville' => $ville,
                            'postale' => $postale,
                            'adresse' => $adresse,
                            'mobile' => $mobile,
                            'token' => $code

                    ));
                    //envoie du mail de confirmation
                    // require 'vendor/autoload.php';
                    // try{
                    // $mail->setFrom('opigezjonathan@gmail.com', 'envoyeur');
                    // $mail->addAddress($email, 'receveur');
                    
                    //                  //Content
                    //                 $mail->isHTML(true);                                  //Set email format to HTML
                    //                 $mail->Subject = 'Email de confirmation';
                    //                 $mail->Body    = 'Merci pour votre inscription, afin de confirmez votre compte, <a href="http://localhost:3000/verification.php?email=' . $email . '&token=' . $code . '">Cliquez-ici</a>';
                                  
                    //                     $mail->send();
                    //                     echo 'Message envoyez';
                    //                 } catch (Exception $e) {
                    //                     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    //                 }


                    header("location:index.php?reg_err=success");
                    die();
                    

                }else header("location:inscription.php?reg_err=password");
            }else header("location:inscription.php?reg_err=email");
        }else header("location:inscription.php?reg_err=email_length");
    }else header("location:inscription.php?reg_err=already");
}
