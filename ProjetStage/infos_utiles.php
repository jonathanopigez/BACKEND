<?php
require_once 'config.php';
session_start();
$page = 4;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/font-face.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="style/cubes.css">
    <link href="style/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <title>Infos utiles</title>

   <style>
  .overview-item{
    padding-bottom: 30px!important;
  }

  label{
color:white;
  }
 .form-group i{
color:white;
  }

  .titre{
    font-size:2em!important;
    color:white!important;
  }
  .section1{
    display:flex;
    gap:30px;
  }

.title-1{
    margin-bottom:
        30px;
    
}
.form-group input{
    background:transparent;
    border: none;
    border-bottom: solid 2px white;
}

.form-group input::placeholder{
    color:white;
}


   </style>
</head>
<body>
    <?php
    include_once 'includes/navbar.php';
    $entreprise = $bdd->query("SELECT * FROM T_D_ENTREPRISE_ENT");
    $entreprise = $entreprise->fetch();

    ?>



<div class="main-content">
    <div class="section__content container">
    <h2 class="title-1">Informations utiles</h2>
            <form method="post" action="infos_utiles_traitement.php">
        <div class="formulaire">
<div class="section1">
 
                <div class="container overview-item bg-dark cards">
                <h4 class="titre">Information de l'entreprise</h4>
                    <div class="form-group">
                    <i class="fa-solid fa-building"></i>
                        <label for="nom">Nom de la société</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="<?php echo $entreprise["ENTREPRISE_NOM_ENT"] ?>" required>
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="nom" name="nom"> <?php echo $entreprise["ENTREPRISE_NOM_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    
                    <div class="form-group">
                    <i class="fa-solid fa-address-book"></i>
                    <label for="adresse">Adresse</label>
                    <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="<?php echo $entreprise["ENTREPRISE_ADRESSE_ENT"] ?>" required>
                    <?php }?>
                    <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="adresse" name="adresse"> <?php echo $entreprise["ENTREPRISE_ADRESSE_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-solid fa-envelope"></i>
                    <label for="zip">Code postal</label>
                    <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Code postal" required pattern="[0-9]{5}">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="zip" name="zip"> <?php echo $entreprise["ENTREPRISE_CODE_POSTALE_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-solid fa-city"></i>
                    <label for="ville">Ville</label>
                    <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" required>
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light"  id="ville" name="ville"> <?php echo $entreprise["ENTREPRISE_VILLE_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-solid fa-phone"></i>
                    <label for="tel">Téléphone</label>
                    <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="Télephone" required pattern="0[1-9][0-9]{8}">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light"  id="tel" name="tel"> <?php echo $entreprise["ENTREPRISE_TELEPHONE_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-solid fa-at"></i>
                    <label for="email">Adresse email</label>
                    <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light"  id="email" name="email"> <?php echo $entreprise["ENTREPRISE_EMAIL_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    </div>
                    <div class="container overview-item au-card--bg-blue cards">
                    <h4 class="titre">Reseaux sociaux</h4>
                    <div class="form-group">
                    <i class="fa-brands fa-facebook"></i>
                    
                        <label for="facebook">Facebook</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="url" class="form-control" id="facebook" name="facebook" placeholder="Facebook">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="facebook" name="facebook"> <?php echo $entreprise["ENTREPRISE_FACEBOOK_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-brands fa-twitter"></i>
                        <label for="twitter">Twitter</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="url" class="form-control" id="twitter" name="twitter" placeholder="Twitter">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="twitter" name="twitter"> <?php echo $entreprise["ENTREPRISE_TWITTER_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-brands fa-youtube"></i>
                        <label for="youtube">Youtube</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="url" class="form-control" id="youtube" name="youtube" placeholder="youtube" value="">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light"  id="youtube" name="youtube"> <?php echo $entreprise["ENTREPRISE_YOUTUBE_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-brands fa-pinterest"></i>
                        <label for="pinterest">Pinterest</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="url" class="form-control" id="pinterest" name="pinterest" placeholder="pinterest" value="">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light"  id="pinterest" name="pinterest"> <?php echo $entreprise["ENTREPRISE_PINTEREST_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-brands fa-instagram"></i>
                        <label for="instagram">Instagram</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="url" class="form-control" id="instagram" name="instagram" placeholder="instagram" value="">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="instagram" name="instagram"> <?php echo $entreprise["ENTREPRISE_INSTAGRAM_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                    <i class="fa-solid fa-rss"></i>
                        <label for="gplus">RSS</label>
                        <?php if($_SESSION["user"]["role"] == "admin"){?>
                        <input type="url" class="form-control" id="rss" name="rss" placeholder="RSS" value="">
                        <?php }?>
                        <?php if($_SESSION["user"]["role"] == "user"){?>
                        <br>
                        <span class="text-light" id="rss" name="rss"> <?php echo $entreprise["ENTREPRISE_RSS_ENT"] ?> </span>
                        <?php }?>
                    </div>
                    </div>
                </div>
                </div>
                <div class="container overview-item bg-info">
                <h4 class="titre">Informations divers</h4>
                    <div class="form-group ">
                    <i class="fa-solid fa-file-arrow-up"></i>
					    <label for="Logo">Logo</label>
					    <input type="file" id="Logo" name="fichier">
                        <img src="" controls="" width="200px">
                    </div>
                    <h4>Nous localiser</h4>
                    <iframe src="https://www.google.fr/maps/place/Paris/@48.8589466,2.2769955,12z/data=!3m1!4b1!4m5!3m4!1s0x47e66e1f06e2b70f:0x40b82c3688c9460!8m2!3d48.856614!4d2.3522219" width="600" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                        <style>iframe{ width:100%!important; height:200px!important; }</style>
                        <div class="form-group">
                        <i class="fa-solid fa-map-location-dot"></i>
							<label for="gmap">Google Map</label>
							<textarea class="form-control" id="gmap" name="gmap" placeholder="Google Map">https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d84184.47051848588!2d1.2878424539475288!3d48.74819132842936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1551ee0688e79%3A0x40dc8d7053981f0!2s28100%20Dreux!5e0!3m2!1sfr!2sfr!4v1643208123814!5m2!1sfr!2sfr</textarea>
						</div>
                        <div class="form-group">
                        <i class="fa-solid fa-book"></i>
							<label for="accroche">Accroche</label>
							<input type="text" class="form-control" id="accroche" name="accroche" placeholder="Accroche"  required="">
						</div>   
                    <h4 class="text-light">Réferencement</h4>
                    <div class="form-group">
                    <i class="fa-solid fa-feather"></i>
						<label for="seo1">Description</label>
						<input type="text" class="form-control" id="seo1" name="seo1" placeholder="Meta Description" required="">
					</div>
                    <div class="form-group">
                    <i class="fa-solid fa-door-open"></i>
						<label for="info_bienvenue">Informations Bienvenue</label>
						<input type="text" class="form-control" id="info_bienvenue" name="info_bienvenue" placeholder="Informations"  required="">
					</div>

                    <div class="form-group">
                    
                    <i class="fa-solid fa-key"></i>
						<label for="seo2">Mots-clés</label>
						<input type="text" class="form-control" id="seo2" name="seo2" placeholder="Meta Keywords">
					</div>
                  
                </div>
                <div class="container text-center">
                <button type="submit" class="btn btn-success" name="modifier">Valider les modifications</button>
                </div>
                </div>
               
            </form>
        </div>
   
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


</body>
</html>