<?php
include_once("entete.php");
include_once("menu.php");
?>
<?php
//include_once("entete.php");
include_once("menu.php");
?>

<div class="row">

                <?php

                    $liste_acteur = Doctrine_core::getTable('Acteur')->findAll();
                    foreach($liste_acteur as $listes){

                        ?>
                        <div class="col-md-3">
                            <!-- CONTACT ITEM -->
                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image">
                                        <img src="dossier/<?php echo $listes->photo; ?>" height="120" width="120" alt="photo"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><?php echo $listes->nom." ".$listes->prenom; ?></div>
                                        <div class="profile-data-name"><?php echo $listes->fonction; ?></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="#" class="profile-control-left" title="Modifier"><span class="fa fa-pencil"></span></a>
                                        <a href="page/cartePdf.php?id=<?php echo $listes->id; ?>" target="_blank" class="profile-control-right" title="Imprimer"><span class="fa fa-print"></span></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="contact-info">
                                        <p><small>Mobile: </small><br/>0241 04 51 76 23</p>
                                        <p><small>Email:</small><br/>nadiaali@domain.com</p>
                                        <p><small>Nationalité:</small><br/><?php echo $listes->nationalite; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- END CONTACT ITEM -->
                        </div>
                    <?php
                    } ?>





        </div>
        <!-- END DEFAULT DATATABLE -->



    </div>
</div>
<?php
include_once("footer.php");
?>