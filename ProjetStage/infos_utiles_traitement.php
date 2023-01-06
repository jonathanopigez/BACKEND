<?php
require_once 'config.php'; // On inclu la connexion à la bdd


// Si les variables existent et qu'elles ne sont pas vides
if(isset($_POST['nom']) && isset($_POST["adresse"]) && isset($_POST["ville"]))
{

     // Empeche faille XSS
     
    $nom_entreprise             = htmlspecialchars($_POST['nom']);
    $adresse_entreprise         = htmlspecialchars($_POST['adresse']);
    $codepostale_entreprise     = htmlspecialchars($_POST['zip']);
    $ville_entreprise           = htmlspecialchars($_POST['ville']);
    $telephone_entreprise       = htmlspecialchars($_POST['tel']);
    $email_entreprise           = htmlspecialchars($_POST['email']);
    $facebook_entreprise        = htmlspecialchars($_POST['facebook']);
    $twitter_entreprise         = htmlspecialchars($_POST['twitter']);
    $youtube_entreprise         = htmlspecialchars($_POST['youtube']);
    $pinterest_entreprise       = htmlspecialchars($_POST['pinterest']);
    $instagram_entreprise       = htmlspecialchars($_POST['instagram']);
    $rss_entreprise             = htmlspecialchars($_POST['rss']);
    $logo_entreprise            = htmlspecialchars($_POST['fichier']);
    $localisation_entreprise    = htmlspecialchars($_POST['gmap']);
    $accroche_entreprise        = htmlspecialchars($_POST['accroche']);
    $description_entreprise     = htmlspecialchars($_POST['seo1']);
    $info_bienvenu_entreprise   = htmlspecialchars($_POST['info_bienvenue']);
    $mots_cles_entreprise       = htmlspecialchars($_POST['seo2']);

                $entreprise = $bdd->prepare('SELECT * FROM T_D_ENTREPRISE_ENT');
                $entreprise->execute(array());
                $data = $entreprise->fetch();
                $row = $entreprise->rowCount();
               

                if($row == 1){   
                      // On insère dans la base de données
                      $update = $bdd->prepare('UPDATE T_D_ENTREPRISE_ENT SET 
                      ENTREPRISE_NOM_ENT = :nom,
                      ENTREPRISE_ADRESSE_ENT = :adresse,
                      ENTREPRISE_CODE_POSTALE_ENT = :zip, 
                      ENTREPRISE_VILLE_ENT = :ville, 
                      ENTREPRISE_EMAIL_ENT = :email,
                      ENTREPRISE_TELEPHONE_ENT = :tel,
                      ENTREPRISE_FACEBOOK_ENT =:facebook,
                      ENTREPRISE_TWITTER_ENT =:twitter,
                      ENTREPRISE_YOUTUBE_ENT = :youtube,
                      ENTREPRISE_PINTEREST_ENT = :pinterest,
                      ENTREPRISE_INSTAGRAM_ENT = :instagram,
                      ENTREPRISE_RSS_ENT = :rss,
                      ENTREPRISE_LOGO_ENT = :fichier,
                      ENTREPRISE_LOCATION_ENT = :gmap,
                      ENTREPRISE_ACCROCHE_ENT = :accroche,
                      ENTREPRISE_DESCRIPTION_ENT =:seo1,
                      ENTREPRISE_INFOBIENVENUE_ENT = :info_bienvenue,
                      ENTREPRISE_MOTS_CLES_ENT = :seo2 ');
                  $update->execute(array(
                          'nom'=> $nom_entreprise,                                 
                          'adresse'=>$adresse_entreprise,   
                          'zip'=> $codepostale_entreprise, 
                          'ville'=>  $ville_entreprise,    
                          'tel' => $telephone_entreprise,  
                          'email' => $email_entreprise,   
                          'facebook' => $facebook_entreprise,   
                          'twitter' => $twitter_entreprise,  
                          'youtube'=> $youtube_entreprise,      
                          'pinterest' => $pinterest_entreprise,  
                          'instagram'=> $instagram_entreprise , 
                          'rss' =>  $rss_entreprise, 
                          'fichier'=> $logo_entreprise, 
                          'gmap'  => $localisation_entreprise,
                          'accroche'=> $accroche_entreprise, 
                          'seo1' =>  $description_entreprise, 
                          'info_bienvenue' =>  $info_bienvenu_entreprise,
                          'seo2' => $mots_cles_entreprise
                          


                  ));
                  header("location:landing.php?reg_err=success");
                  die();
                } 
              
                if($row == 0){  
                      // On insère dans la base de données
                    $insert = $bdd->prepare('INSERT INTO T_D_ENTREPRISE_ENT(
                        ENTREPRISE_NOM_ENT,
                        ENTREPRISE_ADRESSE_ENT,
                        ENTREPRISE_CODE_POSTALE_ENT, 
                        ENTREPRISE_VILLE_ENT, 
                        ENTREPRISE_EMAIL_ENT,
                        ENTREPRISE_TELEPHONE_ENT,
                        ENTREPRISE_FACEBOOK_ENT,
                        ENTREPRISE_TWITTER_ENT,
                        ENTREPRISE_YOUTUBE_ENT,
                        ENTREPRISE_PINTEREST_ENT,
                        ENTREPRISE_INSTAGRAM_ENT,
                        ENTREPRISE_RSS_ENT,
                        ENTREPRISE_LOGO_ENT,
                        ENTREPRISE_LOCATION_ENT,
                        ENTREPRISE_ACCROCHE_ENT,
                        ENTREPRISE_DESCRIPTION_ENT,
                        ENTREPRISE_INFOBIENVENUE_ENT,
                        ENTREPRISE_MOTS_CLES_ENT)VALUE(:nom, :adresse, :zip, :ville, :tel, :email, :facebook, :twitter, :youtube, :pinterest, :instagram, :rss, :fichier, :gmap, :accroche, :info_bienvenue, :seo1, :seo2)');
                    $insert->execute(array(
                            'nom'=> $nom_entreprise,                                 
                            'adresse'=>$adresse_entreprise,   
                            'zip'=> $codepostale_entreprise, 
                            'ville'=>  $ville_entreprise,    
                            'tel' => $telephone_entreprise,  
                            'email' => $email_entreprise,   
                            'facebook' => $facebook_entreprise,   
                            'twitter' => $twitter_entreprise,  
                            'youtube'=> $youtube_entreprise,      
                            'pinterest' => $pinterest_entreprise,  
                            'instagram'=> $instagram_entreprise , 
                            'rss' =>  $rss_entreprise, 
                            'fichier'=> $logo_entreprise, 
                            'gmap'  => $localisation_entreprise,
                            'accroche'=> $accroche_entreprise, 
                            'seo1' =>  $description_entreprise, 
                            'info_bienvenue' =>  $info_bienvenu_entreprise,
                            'seo2' => $mots_cles_entreprise
                            


                    ));
                    header("location:landing.php?reg_err=success");
                    die();
                    
                }
            }