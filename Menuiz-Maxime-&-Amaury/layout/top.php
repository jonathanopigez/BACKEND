<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Boutique</title>
    <style>
        .table_cat {
            width: 85%;
            margin: 0 auto;
            margin-top: 50px;
        }

        .table_cat th {
            text-align: center;
            color: white;
            background: #343a40;
        }

        .table_cat td,
        .th_produits td {
            text-align: center
        }

        .inscrip_form .form-group,
        .inscrip_form .form-btn-group {
            width: 50%;
            margin: 0 auto
        }

        .inscrip_form .form-btn-group {
            margin-top: 20px
        }


        /* ESPACE MAIN */
        main {
            display: flex;
            margin-bottom: 0;
            width: 99%;
        }

        .inscrip_form .btn-primary {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
        }

        .inscrip_form .btn-primary:hover {
            background-color: #6c757d;
        }

        .AffichageProduit {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            flex: 0 0 33.333333%;
        }

        .table_cat th.th_produits,
        .table_cat td.th_produits {
            width: 35%;
        }

        .img_produit {
            width: 50%;
            margin: 0 auto;
            margin-top: 25px
        }

        .card-img-top {
            max-width: 150px;
            margin: 0 auto;
        }

        .panier_quant {
            width: 50px;
            margin: 0 auto
        }

        .cardQ-formTd {
            width: 70px
        }

        .cardQ-formTd .form-btn-group {
            margin-top: 0
        }

        .valid_commande {
            margin-top: 45px;
            margin-right: 7.5%;
        }

        select[name^=statut] {
            margin-right: 15px
        }
    </style>
</head>

<body>
    <?php
    if (isUserAdmin()) :
    ?>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container navbar-nav">
                <a class="navbar-brand" href="index.php">Admin</a>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="admin/produits.php">
                                Gestion produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/commande.php">
                                Gestion des commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="page-recherche-dossier.php">
                                Recherche Dossier
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
    endif;
    ?>
    <?php
    if(isUserHotline()) :
   ?>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container navbar-nav">
                <a class="navbar-brand" href="#">Hotline</a>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="page-recherche-dossier.php">
                                Création Dossier
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#.php">
                                Gestion Dossier
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
    endif;
    ?>
     <?php
    if(isUserSAV()) :
   ?>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container navbar-nav">
                <a class="navbar-brand" href="#">SAV</a>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="page-recherche-dossier.php">
                                Création Dossier
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#.php">
                                Gestion Dossier
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
    endif;
    ?>
    <nav class="navbar navbar-expand-md navbar-light " style="background-color: #e3f2fd;">
        <div class="container navbar-nav">
            <img class="logo headLogo" src="<?= IMG_WEB; ?>MenuizMan_logo.png" alt="logo">
            <a class="navbar-brand" href="index.php">Boutique</a>

            <ul class="navbar-nav">
                <?php
                if (isUserConnected()) :
                ?>
                    <li class="nav-item">
                        <a class="nav-link">
                            <?= getUserFullName(); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                    </li>

                <?php
                else :
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                <?php
                endif;
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">Panier</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mescommandes.php">Mes Commandes</a>
                </li>

                <?php
    if (isUserVisitor()) :
    ?>
        
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="layout/mescommandes.php">
                                Mes Commandes
                            </a>
                        </li> -->
                       
    <?php
    endif;
    ?>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php
        displayFlashMessage();
        ?>
    </div>

    