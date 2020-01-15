
<?php
include_once("entete.php");
include_once("menu.php");
?>
<?php
//include_once("entete.php");
include_once("menu.php");
?>
<?php
$messacate="";
if(isset($_POST['enregistrerCate'])){
    $categorienew= htmlspecialchars($_POST['categorienew']);
    if(empty($categorienew)){
        $messacate="<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Veuillez saisir un libellé pour la catégorie SVP</p>"
            . "</div>";
    }elseif($listeCateNew = Doctrine_core::getTable('Categorie')->findOneByLibelle($categorienew)){
        $messacate="<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>La catégorie -- ".$categorienew." --existe déjà!!!!</p>"
            . "</div>";
    }else{
        $categorieCl =  new Categorie();

        $categorieCl->set('libelle', $categorienew);
        $categorieCl->save();
    }
}

?>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="col-md-6 col-md-offset-2">
        <?php

        echo $messacate;
        ?>

        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #4a8cdb;">
                <span>
                    <h2 class="panel-title" style="color: #ffffff; margin-left: 10px">
                        <i class="fa fa-folder-open"></i>
                        <strong>FORMULAIRE D'UNE NOUVELLE CATEGORIE</strong>
                    </h2>
                </span>
            </div>
            <div class="panel-body">
                Les champs marqués <code>(*)</code> sont obligatoires.<br/><br/>

                <form method="post" action="" enctype="multipart/form-data">

                    <label class="control-label">Libellé<code>(*)</code></label>
                    <div class="form-group has-warning">

                        <input type="text" class="form-control"  name="categorienew" value="<?php echo isset($categorienew)? $categorienew :'';?>"/>
                    </div>






            </div>
            <div class="panel-footer">
                <input class="btn btn-success pull-right" type="submit" id="pc_refresh" value="Enregistrer" name="enregistrerCate">
                <input class="btn btn-default pull-left" type="reset"  value="Réinitialiser">
            </div>
            </form>
        </div>

    </div>
</div>
<?php
include_once("footer.php");
?>