<?php 

class Database
{
    private $host = "mysql:dbname=crud_ajax";
    private $user = "root";
    private $pswd = "";

    private function getConnexion () 
    {
        try{
                return new PDO($this->host, $this->user);
        }catch(PDOException $e){
            die("Erreur:" . $e->getMessage());
        }

    }
        public function create(string $customer, string $cashier, int $amount, int $received, int $returned, string $states)
        {
            $q = $this ->getConnexion()->prepare( "INSERT INTO facture (customer, cashier, amount, received, returned, states) VALUES (:customer, :cashier, :amount, :received, :returned, :states)");
            return $q->execute([
                'customer'  => $customer,
                'cashier'  => $cashier,
                'amount'  => $amount,
                'received'  => $received,
                'returned'  => $returned,
                'states'  => $states
            ]);
        }
            public function read(){
              return  $this->getConnexion()->query("SELECT * FROM facture ORDER BY id")->fetchAll(PDO::FETCH_OBJ);
            }

            public function countBills(): int
            {
                        return (int)$this->getConnexion()->query("SELECT COUNT(id) as count FROM facture")->fetch()[0];
            }

            public function getSingleBill(int $id)
            {
                $q = $this->getConnexion()->prepare("SELECT * FROM facture WHERE id = :id");
                $q->execute(['id' =>$id]);
                return $q->fetch(PDO::FETCH_OBJ);
            }

    }
