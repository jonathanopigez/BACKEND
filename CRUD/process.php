<?php
require_once 'model.php';
$db = new Database();
//Creation factures

if(isset($_POST["action"])&& $_POST["action"] == "create"){
    extract($_POST);
    $returned = (int)$amount - (int)$received;
    $db->create($customer, $cashier, (int)$amount, (int)$received, (int)$returned, $states);
    echo 'perfect';
}


//Récupérer les factures

if(isset($_POST["action"])&& $_POST["action"] == "fetch"){
    $output = '';
    if($db->countBills()>0){
    $bills = $db->read();
        $output .= "
            
    <table class=\"table table-striped\">
    <thead>
       <tr>
        <th scope=\"col\"></th>
        <th scope=\"col\">Client</th>
        <th scope=\"col\">Caissier</th>
        <th scope=\"col\">Montant</th>
        <th scope=\"col\">Perçu</th>
        <th scope=\"col\">Retourné</th>
        <th scope=\"col\">Etat</th>
        <th scope=\"col\">Actions</th>
      </tr>
  </thead>
  <tbody>
        ";

        foreach($bills as $bill){
                $output .= "
                <tr>
                <th scope=\"row\">$bill->id</th>
                <td>$bill->customer</td>
                <td>$bill->cashier</td>
                <td>$bill->amount</td>
                <td>$bill->received</td>
                <td>$bill->returned</td>
                <td>$bill->states</td>
                <td>
                <a href=\"#\" data-id=\"$bill->id\" class=\"text-info me-2 infoBtn\" title=\"Voir détails\"><i class=\"fas fa-info-circle\"></i></a>
                <a href=\"#\" data-id=\"$bill->id\" class=\"text-primary me-2 editBtn\" title=\"Modifier\"><i class=\"fas fa-edit\" data-bs-toggle=\"modal\" data-bs-target=\"#updateModal\"></i></a>
                <a href=\"#\" data-id=\"$bill->id\" class=\"text-danger me-2 infoBtn\" title=\"Supprimer\"><i class=\"fas fa-trash-alt\"></i></a>
               </td>
              </tr>
               "; 
        }

        $output .= "</tbody></table>";
        echo $output;
    }else{
        echo "<h3>Aucunes factures pour le moment</h3>";
    }
}

//Info pour detail de facture
if(isset($_POST["workingId"])){
    $workingId = (int)$_POST['workingId'];
   echo json_encode( $db->getSingleBill($workingId));
}