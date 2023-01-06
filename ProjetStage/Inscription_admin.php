<?php
require_once 'config.php';
session_start();
?>


<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="NoS1gnal"/>
            <link rel="stylesheet" href="/style/style.css">
            <link rel="stylesheet" href="/style/wave.css">
            <link rel="stylesheet" href="/style/connexion_inscription.css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            
            <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">         
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />   


<style>
    body{
        overflow:hidden;
    }
</style>


<title>Ajouter un administrateur</title>
        </head>
        <body>
         <?php

         include_once 'includes/navbar.php';
         ?>
        <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
        </div>
        <div class="login-form">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                            ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong> inscription réussie !
                                </div>
                            <?php
                            break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email trop long
                            </div>
                        <?php 
                        break;

                        case 'pseudo_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> pseudo trop long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>
            
            <form action="inscription_admin_traitement.php" method="post">
                <h2 class="text-center titre">Ajouter un Administrateur</h2>
             
                <div class="" id="identite">     
                <div class="form-group">
                <i class="fa-solid fa-user"></i>
                    <input type="text" name="admin_nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="text" name="admin_prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off">
                </div>
                </div>  
                <div class="form-group">
                <i class="fa-solid fa-at"></i>
                    <input type="email" name="admin_email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                <i class="fa-solid fa-lock"></i>
                    <input type="password" name="admin_password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="password" name="admin_password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                <i class="fa-solid fa-shield"></i>
                    <select name="type_administrateur" id="type_admin">
                        <option value="3">Niveau 3</option>
                        <option value="2">Niveau 2</option>
                        <option value="1">Niveau 1</option>
                    </select>
                </div>
               
               
                <div class="divBtn">
                    <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                    <a href ="landing.php"class="btn btn-primary btn-block">Retour</a>
                </div>   
            </form>
        </div>
   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script src="process.js"></script>
        <?php
      include_once 'includes/footer.php'
      ?>
        </body>
</html>