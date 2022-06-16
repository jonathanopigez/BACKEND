<?php session_start()
  ?>;

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Accueil </title>
</head>
<body>   
 <?php
 // HEADER
 $btnId = 0;
 include "header.php";
    echo "<main>";

            echo '<div id="admin-box" class="box-container">';
            echo '<div class="adminPage">';
            echo '<div class="fold-container shadow form-admin">';
                 
            if (isset($_SESSION["name"])) {
                echo '<H1 class="form-legend">Bienvenue ' . $_SESSION["name"] . ' !</H1>';
                echo '<br /><br /><a href="logout.php">Se déconnecter</a>';
                } else {
                header("location:pdo_login.php");
                }
                  
            echo '</div>';
            echo '</div>'; 
            echo '<div class="adminPage">';
            echo '<div  class="fold-container shadow form-admin">';
       
            echo '</div>';
            echo '</div>';
            echo '</div>';
       
           
            // Souvent on identifie cet objet par la variable $conn ou $db
            $mysqlConnection = new PDO('mysql:host=localhost;dbname=menuiz;charset=utf8', 'root', '');
            $produitStatement = $mysqlConnection->prepare('SELECT * FROM T_D_PRODUCT_PRD');
    
            $produitStatement->execute();
            $produits = $produitStatement->fetchAll();
    
            // On affiche chaque produit un à un
            echo '<div class="listProduct container">';
            foreach ($produits as $produit) {
            ?>         <div class="card"><h3><?php echo $produit['PRD_DESCRIPTION']; ?></h3>

<a href="page_produit.php?idProduit='<?php echo $produit['PRD_ID'] ?>'"><img class="imageProduct"  src="<?php echo $produit['PRD_PICTURE']?>"/></a>
                                        <!-- <a href="page_produit.php?idProduit="<?php echo $produit['PRD_ID']; ?>> <img class="imageProduct" src=<?php echo $produit['PRD_PICTURE']; ?>/> </a>     -->
                                         <h3><?php echo $produit['PRD_PRICE']."€" ; ?></h3>
                                         
                                         <a href="panier.php?action=ajout&amp;id_produit=' . $produit['PRD_ID'] . '&amp;quantite=1" 
       onclick="window.open(this.href, '', 
       'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes,
        copyhistory=no, width=600, height=350'); return false;"
          class="add-to-cart btn btn-primary">Ajouter au panier</a>;
 
                                         <!-- <button class="btnAchat" id=<?php echo $btnId."btn";?> ><img src= img/basket-svgrepo-com.svg /></button> -->
            </div>
                       
            <?php
             $btnId ++;
            }
            
            
   
echo '</div>';        
    echo "</main>";
    // FOOTER
     include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>