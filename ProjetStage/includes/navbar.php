
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="style/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="style/theme.css" rel="stylesheet" media="all">

</head>


    <div class="page-wrapper">

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
            <i class="fa-solid fa-globe" style="font-size:2em; margin:10px"></i>
            <h2>WorkSpace</h2>
            </div>
            <div style="gap:10px; padding:50px;display:flex; flex-direction:column; justify-content:center; align-items:center;background-color:#DFD6EB;">
            <i class="fa-solid fa-user fa-4x"></i>
                <h4><?php echo $_SESSION["user"]["nom"]." ".$_SESSION["user"]["prenom"];?></h4>
                <span>type :<?php echo $_SESSION["user"]["role"];?></span>
                <a href="profile.php"><i class="fa-solid fa-gear"></i> Mettre à jour</a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list" id="nav">
                        <li <?php if($page == 1){ ?> class="active"<?php } ?>>
                            <a class="js-arrow" href="landing.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li <?php if($page == 2){ ?> class="active"<?php } ?>>
                            <a href="gestion_devis_facture.php">
                                <i class="fas fa-chart-bar"></i>Devis/factures</a>
                        </li>
                        <?php if ($_SESSION["user"]["role"] == "admin" ){?>
                        <li <?php if($page == 3){ ?> class="active"<?php } ?>>
                            <a href="gestion_utilisateur.php">
                                <i class="fas fa-table"></i>Gestion des membres</a>
                        </li>
                        <?php }?>
                        <li <?php if($page == 4){ ?> class="active"<?php } ?>>
                            <a href="infos_utiles.php">
                                <i class="far fa-check-square"></i>Infos utiles</a>
                        </li>
                      
                        
                    </ul>
                    <div class="text-center" style="margin-top:20px">
                   <a href="deconnexion.php"> <button class="btn btn-danger">Déconnexion</button></a>
                   </div>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                       
                            </form>
                           
                        </div>
                    </div>
                </div>
            </header>



