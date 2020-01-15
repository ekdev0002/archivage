<?php
include_once("entete.php");

?>
<?php
//include_once("entete.php");
include_once("menu.php");
?>
<?php
//controle total de controle
$nombreTotal=Doctrine_Query::create()->select('COUNT(id) as nbrTatal')
    ->from('Archive')
    ->execute(array(),Doctrine::HYDRATE_RECORD);
$nbrTotalArchive= $nombreTotal[0]['nbrTatal'];

?>


    <div class="page-content-wrap">

        <div class="row">

            <div class="col-md-3">

                <!-- START WIDGET MESSAGES -->

                <div class="widget widget-info widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-archive" style="color: #0000ff"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count"><?php echo $nbrTotalArchive; ?></div>
                        <div class="widget-title">Document(s)</div>
                        <div class="widget-subtitle">Dans la base de données</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                    <a href="listDocument.php" class="btn btn-info">VOIR LA LISTE</a>
                </div>
                <!-- END WIDGET MESSAGES -->

            </div>
<?php

$liste_categorie = Doctrine_core::getTable('Categorie')->findAll();
foreach($liste_categorie as $categorie){

    ?>
            <div class="col-md-3">

                <!-- START WIDGET REGISTRED -->
                <div class="widget widget-default widget-item-icon" >
                    <div class="widget-item-left">
                        <span class="fa fa-folder"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-title"><?php echo $categorie->libelle; ?></div>
                        <div class="widget-int num-count"><?php
                            $id=$categorie->id;
                            $nombreTotalParCate=Doctrine_Query::create()->select('COUNT(id) as nbrTatalCate')
                                ->from('Archive')
                                ->where("id_categorie=".$id)
                                ->execute(array(),Doctrine::HYDRATE_RECORD);
                            $nbrTotalCateg= $nombreTotalParCate[0]['nbrTatalCate'];

                            echo $nbrTotalCateg;
                            ?></div>

                        <div class="widget-subtitle">On your website</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                    <a href="listDocumentR.php?dossier=<?php echo $categorie->id; ?>" class="btn btn-info">VOIR LA LISTE</a>
                </div>
                <!-- END WIDGET REGISTRED -->

            </div>
    <?php }?>

        </div>
    </div>

<?php
include_once("footer.php");
?>