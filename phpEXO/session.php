<?php
 
 
    session_start();
 
if ($_SESSION["connecter"] != "yes") {
header("location:login.php");
exit();
}
if (date("H") < 18)
$bienvenue = "Bonjour et bienvenue "  .
$_SESSION["prenom_nom"];
else
$bienvenue = "Bonsoir et bienvenue "  .
$_SESSION["prenom_nom"];
?>
 
<!DOCTYPE  html>
<html>
<head>
<meta  charset="utf-8"  />
<title>Accueil</title>
<link rel="stylesheet" href="CSS/style.css">

</head>
<body  onLoad="document.fo.login.focus()">
<?php include "header.php";?>

<div class="panier"><?php include"panier.php";?></div>
<h2 class="bienvenue"><?php  echo  $bienvenue  ?></h2>
<?php

 $mysqlConnection = new PDO('mysql:host=localhost;dbname=menuiz;charset=utf8', 'root', '');
 $produitStatement = $mysqlConnection->prepare('SELECT * FROM T_D_PRODUCT_PRD');

 $produitStatement->execute();
 $produits = $produitStatement->fetchAll();

 include"produits.php";

//  echo '<div id="product-box" class="box-container">';
//     echo '<h1 class="title"> Nos produits : </h1><br>';
//     // echo '<div class="center"';
//     echo '<div class="container-card">';

// /* Création d'un formulaire pour chaque produit de la base de données. */
// foreach ($produits as $produit) {
//             //  <p><?php echo $produit['PRD_DESCRIPTION']; </p> 
            
//             echo '<form id="product-form-'.$produit['PRD_ID'].'" method="post" action="">'."\n";
//             echo '<div id="card-'.$produit['PRD_ID'].'" class="card-produit card-'.$produit['PRD_ID'].'">';
//             echo '<img src="'.$produit['PRD_PICTURE'].'" alt="Produit : ID = '.$produit['PRD_ID'].'">';
//             echo '<div id="product-'.$produit['PRD_ID'].'" class="container-product">';
//             echo '<h3 class="card-title">'. $produit['PRD_DESCRIPTION'].' </h3>';
//             echo '<p class="prix">'.$produit['PRD_PRICE'].'€</p>';
//             echo '<input type="submit" id="submit-product-'.$produit['PRD_ID'].'" name="submit" value="Ajouter au Panier" action="/>';
//             echo '</div>';
//             echo '</div>';
//             echo '</form>'."\n";
//     }
    include"footer.php"?>
</body>
</html>