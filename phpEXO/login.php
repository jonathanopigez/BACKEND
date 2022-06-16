<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" description="menuiserie intranet">
        <link rel="stylesheet" href="CSS/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Accueil </title>
</head>

<body>

    <?php
 session_start();
 include "header.php";
 $_SESSION['login'] = '';
 $_SESSION['password'] = '';
 if (isset($_POST['submit'])){
 // bouton submit pressé, je traite le formulaire
 $login = (isset($_POST['login'])) ? $_POST['login'] : '';
 $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
 if (($login == "Matthieu") && ($pass == "NewsletTux")){
 $_SESSION['login'] = "Matthieu";
 $_SESSION['password'] = "NewsletTux";
 echo '<a href="accueil.php" title="Accueil de la section
membre">Accueil</a>';
 }
 else{
 // une erreur de saisie ...?
 echo '<p style="color:#FF0000; font-weight:bold;">Erreur de
connexion.</p>';
 }
 }; // fin if (isset($_POST['submit']))
 if (!isset($_POST['submit']))
 {
 // Si bouton submit non pressé, alors j'affiche le
//formulaire
 echo '<form id="conn" method="post" action="">'."\n";
 echo ' <p><label for="login">Login :</label><input
type="text" id="login" name="login" /></p>'."\n";
 echo ' <p><label for="pass">Mot de Passe
:</label><input type="password" id="pass" name="pass"
/></p>'."\n";
 echo ' <p><input type="submit" id="submit"
name="submit" value="Connexion" /></p>'."\n";
 echo '</form>'."\n";
 };
  // fin if (!isset($_POST['submit'])))
  include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>



</html>