<?php
require_once 'config.php';

?>


<!DOCTYPE html>
    <html lang="en">
        <head>


            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="NoS1gnal"/>
           
            <link rel="stylesheet" href="style/cubes.css">
           
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style/inscription.css">


            <title>Inscription</title>
        </head>
        <body>
   
        <div class="login-form container">
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
            
            <form action="inscription_traitement.php" method="post">
                <h2 class="text-center">Inscrivez-vous</h2>
                <label for="type_uti">Vous êtes ?</label>

                <div class="form-group ">
                    <select name="typeUtilisateur" id="type_uti">
                        <option value="0">Particulier</option>
                        <option value="1">Professionnel</option>
                    </select>
                </div>
                <div class="" id="identite">     
             <div class="form-group">
             <i class="fa-solid fa-user"></i>
                    <input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off">
                </div> 
                </div>  
                <div class="form-group">
                <i class="fa-solid fa-at"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                <i class="fa-solid fa-earth-americas"></i>
                    <div class="paysForm">
               
                   <select type="pays" name="pays" requiered="required" id="pays">
                   <option  id=fr value=France data-code=33 selected>France</option>
                   <?php
                    $output = '';
                    $countries =  $bdd->query("SELECT * FROM T_D_PAYS_PAY ORDER BY PAYS_ID_PAY");
                    foreach($countries as $country){
                        $output .= "
                 
                        <option  id=$country[PAYS_ALPHA2_PAY] value=$country[PAYS_NOM_PAY] data-code=$country[PAYS_MOBILECODE_PAY]>$country[PAYS_NOM_PAY]</option>
                        
                     
                        ";
                    }
                    
                    echo $output;
                        ?>
                   </select>
                  <div id="flagDiv">

                  <img class="flagsvg" src="images/flag/svg/fr.svg">
                                                                
                <h5>+33</h5>
                  </div>
                   
              
                  
                  <i class="fa-solid fa-mobile-screen-button" id="logomobile"></i>
                   <input type="mobile" name="mobile" id="phone" class="form-control" placeholder="Numéro de télephone" autocomplete="off">
                </div>
                </div>
                <div class="form-group">
                <i class="fa-solid fa-city"></i>
                    <input type="ville" name="ville" class="form-control" placeholder="Ville" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="postale" name="postale" class="form-control" placeholder="Code postale" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="adresse" name="adresse" class="form-control" placeholder="Adresse" required="required" autocomplete="off">
                </div>
                <div class="form-group decale">
                    <input type="adresse1" name="adresse1" class="form-control" placeholder="Complement d'adresse" autocomplete="off">
                </div>
               
                <div class="divBtn">
                    <button type="submit" class="btn btn-success btninscription" id="button1">Inscription</button>
                    <div class="text-center">
                    <a href="index.php" class="btn btn-block" id="button2">déjà inscrit ?</a>
                    </div>
                </div>   
            </form>
        </div>
        <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script src="js/process.js"></script>
        </body>
</html>