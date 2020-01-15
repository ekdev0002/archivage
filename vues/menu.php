<body>
<?php
include("../librairies/doctrine/config/global.php");
?>

<!-- START PAGE CONTAINER -->
<div class="page-container">

<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="#">Web Archive</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="../assets/images/users/defaut.jpg" alt="utilisateur"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="../assets/images/users/defaut.jpg" alt="utilisateur"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php
                        /*$profil=Doctrine_Core::getTable("Profil");
                        $reqProfil=$profil->findOneById($_SESSION['profil']);

                        echo $_SESSION['nom']." ".$_SESSION['prenom']." (".$reqProfil->libelle.")";*/

                        ?></div>
                    <div class="profile-data-title"></div>
                </div>
                <div class="profile-controls">
                    <a href="index.php?page=mon-compte" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>
        <?php //if($_SESSION['profil']==3) { ?>
            <li class="active">
                <a href="index.php"><span class="fa fa-desktop" style="color:white"></span> <span class="xn-text">Tableau de Bord</span></a>
            </li>
        <?php //} ?>






        <li class="xn-openable">
            <a href="#"><span class="fa fa-archive" style="color:white"></span> <span class="xn-text">Gestion des Archives</span></a>
            <ul>
                <li><a href="newArchive.php"><span class="fa fa-list"></span>Archiver Document</a></li>
                <li><a href="newCategorie.php"><span class="fa fa-list"></span>Nouvelle Categorie</a></li>
                <li><a href="listDocument.php"><span class="fa fa-list"></span>Liste des Archives</a></li>
            </ul>
        </li>
        <?php //if($_SESSION['profil']==2 or $_SESSION['profil']==3) { ?>
            <li class="xn-openable">
                <a href="#"><span  class="fa fa-users" style="color:white"></span> <span class="xn-text">Gestion des Utilisateurs</span></a>
                <ul>

                    <li><a href="inscription.php"><span class="fa fa-list"></span>Nouveau Utilisateur</a></li>
                    <li><a href="listUsers.php"><span class="fa fa-list"></span>Liste des Utilisateurs</a></li>

                </ul>
            </li>
        <?php //}?>

        <?php //if($_SESSION['profil']==4) { ?>

            <li class="xn-openable">
                <a href="#"><span class="fa fa-cogs" style="color:white"></span> <span class="xn-text">Parametrage</span></a>

            </li>
        <?php //}?>

        <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->


<!-- PAGE CONTENT -->
<div class="page-content">

    <!-- START X-NAVIGATION VERTICAL -->
    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
        <!-- TOGGLE NAVIGATION -->
        <li class="xn-icon-button">
            <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
        </li>
        <!-- END TOGGLE NAVIGATION -->
        <!--
        <li class="xn-search">
            <form role="form">
                <input type="text" name="search" placeholder="Rechercher..."/>
            </form>
        </li>
        -->
        <!-- SIGN OUT -->
        <li class="xn-icon-button pull-right">
            <a href="#" class="mb-control" title="Deconnexion" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
        </li>
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> <strong>Deconnexion</strong> ?</div>
                    <div class="mb-content">
                        <p>VOULEZ VOUS VRAIMENT VOUS DECONNECTEZ?</p>

                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="deconnexion.php" class="btn btn-success btn-lg">OUI</a>
                            <button class="btn btn-default btn-lg mb-control-close">NON</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </ul>
    <!-- END X-NAVIGATION VERTICAL -->

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">

        <li class="active"></li>
    </ul>
    <!-- END BREADCRUMB -->