<?php
class ModeleDetail
{
    private $idc;
    private function connexion()
    {
        $this->idc = new PDO("mysql:host=localhost; dbname=menuiz", 'root', '');
    }

    // fonction pour afficher le detail du dossier avec le numero dossier
    public function afficheDossierProduit()
    {
        // echo $numDossier;
        $this->connexion();
        $res = $this->idc->prepare("SELECT SAV.*,DSV.*,PRD.*,DGC.*,PTY.* 
        FROM t_d_dossiersav_sav SAV 
        INNER JOIN t_d_detailsav_dsv DSV 
        ON SAV.SAV_ID=DSV.SAV_ID 
        INNER JOIN t_d_product_prd PRD 
        ON DSV.PRD_ID=PRD.PRD_ID 
        LEFT JOIN t_d_diagnostic_dgc DGC 
        ON DGC.SAV_ID = DSV.SAV_ID 
        INNER JOIN t_d_producttype_pty PTY 
        ON PRD.PTY_ID = PTY.PTY_ID 
        WHERE SAV.SAV_NUM_DOSSIER = 598968;");
        $res->execute();
        return $res;
    }
}
