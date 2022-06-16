<?php
session_start();
include 'header.php';
include("infos.php");
@$valider = $_POST["inscrire"];
$erreur = "";
if (isset($valider)) {
if (empty($nom)) $erreur = "Le chanmps nom est obligatoire !";
elseif (empty($prenom)) $erreur = "Le chanmps prénom est obligatoire !";
elseif (empty($pseudo)) $erreur = "Le chanmps Pseudo est obligatoire !";
elseif (empty($password)) $erreur = "Le chanmps mot de passe est obligatoire !";
elseif ($password != $passwordConf) $erreur = "Mots de passe differents !";
else {
include("connexion.php");
$verify_pseudo = $pdo->prepare("select USR_ID from t_d_user_usr where username=? limit 1");
$verify_pseudo->execute(array($pseudo));
$user_pseudo = $verify_pseudo->fetchAll();
$verify_email = $pdo->prepare("select USR_ID from t_d_user_usr where USR_MAIL=? limit 1");
$verify_email->execute(array($email));
$user_email = $verify_email->fetchAll();
if (count($user_pseudo) > 0)
$erreur = "Pseudo existe déjà!";
if(count($user_email) > 0 )
$erreur = "mail deja pris";
else {
$ins = $pdo->prepare("insert into t_d_user_usr(USR_LASTNAME,USR_FIRSTNAME,username,USR_PASSWORD, USR_MAIL) values(?,?,?,?,?)");
if ($ins->execute(array($nom, $prenom, $pseudo, sha1($password), $email)))
header("location:pdo_login.php");
     }
   }

}

?>
<!DOCTYPE  html>
 
<html>
<head>
<meta  charset="utf-8"  />
<link rel="stylesheet" href="CSS/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div  class="erreur"><?php  echo  $erreur  ?></div>
<div class="formulaireInscription container">
<h1>Inscription</h1>
<form  name="fo"  method="post"  action="">
<input  type="text"  name="nom"  placeholder="Nom"  value="<?=  $nom  ?>"  /><br  />
<input  type="text"  name="prenom"  placeholder="Prénom"  value="<?=  $prenom  ?>"  /><br  />
<input  type="text"  name="pseudo"  placeholder="Votre Pseudo"  value="<?=  $pseudo  ?>"  /><br  />
<input  type="email" name="email" placeholder="Votre adresse mail"/> <br>
<input  type="password"  name="password"  placeholder="Mot de passe"  /><br  />
<input  type="password"  name="passconf"  placeholder="Confirmer votre Mot de passe"  /><br  />
<input  type="submit"  name="inscrire"  value="S'inscrire"  />
<a  href="login.php">Deja un compte</a>
</form>
</div>

<?php include 'footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>