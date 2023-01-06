<?php 

class ModelDossierSAV
{
    private $idc;
    private function connexion()
    {
        $this->idc = new PDO("mysql:host=localhost;  dbname=menuiz", 'root', '');
    }

    public function RecupSavTypeById($id)
    {
        $this->connexion();
        $res = $this->idc->prepare("SELECT STY.*, SAV.* 
        FROM t_d_savtype_sty sty inner join t_d_dossiersav_sav sav
        on STY.STY_ID=SAV.STY_ID
         where USR_ID= '" . $id . "';");
        $res->execute();
        return $res;
    }

    public function AfficheDossierSAV($sqlwhere)
    {
        $this->connexion();
$sql="SELECT OHR.*, SAV.*, USR.*, STY.*
FROM t_d_orderheader_ohr OHR LEFT JOIN t_d_dossiersav_sav SAV
 ON OHR.OHR_ID=SAV.OHR_ID 
LEFT JOIN t_d_user_usr USR ON OHR.USR_ID=USR.USR_ID
LEFT JOIN t_d_savtype_sty STY ON SAV.STY_ID=STY.STY_ID";

if (!empty($sqlwhere)){
    $sql.=" WHERE " .$sqlwhere .";";
}

        $res = $this->idc->prepare($sql);
        $res->execute();
        return $res;
    }

    public function InsertDossierSav($lastname, $firstname, $numCommande, $email, $explication, $usrid)
    {

        $this->connexion();
        $query = 'INSERT INTO t_d_dossiersav_sav
       (
       SAV_NUM_DOSSIER,
       STY_ID,
       USR_ID,
       OHR_NUMBER,
       SAV_DESCRIPTION)
       VALUES
       (  
            :savNumDoss,
            1,
            :usrId,
            :ohrNumber,
            :savDesc
        )';

        $stmt = $this->idc->prepare($query);
        $stmt->execute([
            ':savNumDoss' =>$numCommande,
            // ':styId' => $SavType,
            ':usrId' => $usrid,
            ':ohrNumber' => $numCommande,
            ':savDesc' => $explication
        ]);

       $id = $this->idc->lastInsertId();

        // on met à jour l'ordernumber
        // $query = 'update t_d_user_usr set OHR_NUMBER=:ordernumber where OHR_ID=:orderid';
        // $stmt = $this->idc->prepare($query);
        // $stmt->execute([
        //     ':ordernumber' => 'ORDER' . $id,
        //     ':orderid' => $id
        // ]);

        // on retourne le dernier id
        return $id;
    }

    public function RecupTypeSav($sqlwhere)
    {
        $this->connexion();
        $res = $this->idc->prepare("SELECT STY.*, SAV.* 
        FROM t_d_savtype_sty STY;");
        $res->execute();
        return $res;
    }

}





?>