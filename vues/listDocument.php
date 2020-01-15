
<?php
include_once("entete.php");

?>
<?php
include_once("menu.php");
?>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">LISTE DES DOCUMENT ARCHIVES</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>NUMERO</th>
                            <th>TITRE</th>
                            <th>DOCUMENT</th>
                            <th>Mots clés</th>
                            <th>ACTION</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $i=0;
                        $liste_donneurs = Doctrine_core::getTable('Archive')->findById_acteur($_SESSION['identifiant']);
                        foreach($liste_donneurs as $listes){
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td style="font-size: large"><?php echo $listes->titre; ?></td>
                                <td><a href="<?php echo "files/".$_SESSION['identifiant']."/".$listes->fichier; ?>" target="_blank"><?php echo $listes->nomfichier; ?></a></td>
                                <td><?php echo $listes->motcle; ?></td>



                                <td>  <a class="btn btn-default" href="<?php echo $listes->fichier; ?>" target="_blank">
                                        <i class="fa fa-eye"></i></a>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_modifier_donneur">
                                        <i class="fa fa-pencil"></i></button>

                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_large<?php echo $listes->id; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </button>


                                </td>
                            </tr>

                            <div class="modal" id="modal_large<?php echo $listes->id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 style="color: green; text-align: center" class="modal-title" id="largeModalHead"> FENETRE DE CONFIRMATION</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                VOULEZ VOUS VRAIMENT SUPPRIMER CE DOCUMENT?? <?php //echo $listes->numero; ?> ?
                                                <form method="post" action="">
                                                    <input type="hidden" class="form-control" name="id_donneur" value="<?php echo $listes->id; ?>"/>



                                            </div>

                                            <div class="modal-footer">
                                                <input class="btn btn-success pull-left" type="submit"  value="OUI" name="enregistrer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
                                            </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php
                        } ?>



                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



        </div>
    </div>

</div>
<!-- END PAGE CONTAINER -->

<?php
include_once("footer.php");
?>