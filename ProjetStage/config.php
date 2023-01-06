 <?php
// requete qui créer la connexion a la base de données
try{
    $bdd = new PDO ("mysql:host=localhost;dbname=projetstage;charset=utf8",'root','');

}catch(Exception $e)
{
    die('Erreur' .$e->getMessage());
}



