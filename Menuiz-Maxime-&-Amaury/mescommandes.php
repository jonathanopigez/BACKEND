<?php
/* 
 * Lister les commandes dans un tableau HTML
 * id de la commande
 * nom prenom de l'utilisateur qui a passé la commande
 * montant formaté
 * date de la commande
 * statut
 * date de statut
 * 
 * Passer le statut en liste deroulant avec un bouton Modifier
 * pour changer le statut de la commande en bdd (nécessité un champs caché pour l'id de la commande)
 */

require_once __DIR__ . '/Include/init.php';
adminSecurity();

// concat_ws(' ', u.prenom, u.nom) //concatenation valeur sql
$query = 'SELECT C.*,U.USR_FIRSTNAME as user_name, U.USR_LASTNAME as user_prenom 
FROM T_D_ORDERHEADER_OHR C 
INNER JOIN T_D_USER_USR U ON C.USR_ID = U.USR_ID where U.USR_id= ' . $_SESSION['utilisateur']['id'];
$stmt = $pdo->query($query);
$commandes = $stmt->fetchAll();



require __DIR__ . '/layout/top.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1 style="text-align: center">Commandes</h1>

<div class="d-grid gap-2 col-2 mx-auto">
    <a href="page-creation-dossier.php" class="btn btn-dark ">Ouvrir un ticket</a>
</div>
<!-- le tableau HTML ici -->
<div class="d-grid gap-2 col-8 mx-auto">
<table class="table_cat th_produits table table-striped table-dark ">
    <tr>
        <th>Numéro de commande</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Date de commande</th>
        <th>Statut</th>
        <th></th>
    </tr>

    <?php foreach ($commandes as $commande) :    ?>
        <tr>
            <td><?= $commande['OHR_NUMBER']; ?></td>
            <td><?= $commande['user_name']; ?></td>
            <td><?= $commande['user_prenom']; ?></td>
            <td><?= datetimeFR($commande['OHR_DATE']); ?></td>

            <td>
                <?php
                //faire une verif en BDD pour voir si l'id enregistré dans la commande correspond au libellé de la table statuts via son id
                $stm = $pdo->query('select OSS_ID,OSS_WORDING from T_D_ORDERSTATUS_OSS where OSS_ID= ' . $commande['OSS_ID'] . ' ');
                $commande_statut = $stm->fetchAll();

                echo $commande_statut[0]['OSS_WORDING'];
                ?>
            </td>

        </tr>

    <?php
    endforeach;
    ?>
</table>
</div>


<?php
require __DIR__ . '/layout/bottom.php';
?>

<script>

</script>
</body>
</html>
