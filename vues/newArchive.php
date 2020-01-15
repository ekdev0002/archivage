
<?php
include_once("entete.php");
include_once("menu.php");
?>
<?php
//include_once("entete.php");
include_once("menu.php");
?>
<?php
$dir="files/".$_SESSION['identifiant'];
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
<?php
$mes="";

if(isset($_POST['enregistrer'])){
    $date_pub =date('d-m-Y');
    $titre = htmlspecialchars($_POST['titre']);
    $motcle = htmlspecialchars($_POST['motcle']);
    $fil_tmp=$_FILES['fichier']['tmp_name'];
    $nomdufichier=$_FILES['fichier']['name'];
    $extensions=array('pdf','doc');
    //$extension = strrchr($_FILES['photo']['name'], '.');
    $extension_upload = strtolower(  substr(  strrchr($nomdufichier, '.')  ,1) );
    //echo "-----------------------------------".$extension;
//Ensuite on teste
   /* if(!in_array($extension_upload,$extensions)) //Si l'extension n'est pas dans le tableau
    {
        $mes= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Vous devez uploader un fichier de type pdf ou doc</p>"
            . "</div>";
    }*/
if(empty($titre)){
         $mes= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
             . "<p>Veuillez ajouter un titre SVP</p>"
             . "</div>";
     }


    else{
        $id_derniere_ass=Doctrine_Query::create()->select('Max(id) as id_ass')->from('Archive')
            ->execute(array(),Doctrine::HYDRATE_RECORD);
        $id_acteur= $id_derniere_ass[0]['id_ass'];
        $text=str_replace(' ','-',$nomdufichier);
        $text1=str_replace('_','-',$text);
        $nombre= strlen ($extension_upload);
        $text2= substr($text1, 0, -($nombre+1));
        $image =$text2.($id_acteur+1).".".$extension_upload ;
        $donneur =  new Archive();

        $donneur->set('fichier', $image);
        $donneur->set('titre', $titre);
        $donneur->set('date_publication', $date_pub);
        $donneur->set('nomfichier', $nomdufichier);
        $donneur->set('fichier', $image);
        $donneur->set('motcle', $motcle);
        $donneur->set('id_acteur', $_SESSION['identifiant']);
        
        if(is_dir($dir)===false){
            mkdir($dir);
        }

        move_uploaded_file($fil_tmp, $dir."/".$image);

        $donneur->save();

        $mes= "<div class='alert alert-success' style='margin-top:10px;text-align:center;'>"
            . "<p>VEUILLEZ ENREGISTREMENT EFFECTUE AVEC SUCCES</p>"
            . "</div>";
    }

}


?>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
<div class="col-md-6 col-md-offset-2">
<?php
echo $mes;
echo $messacate;
?>

    <div class="panel panel-info">
        <div class="panel-heading" style="background-color: #4a8cdb;">
                <span>
                    <h2 class="panel-title" style="color: #ffffff; margin-left: 10px">
                        <i class="fa fa-folder-open"></i>
                        <strong>FORMULAIRE D'UN NOUVEAU DOCUMENT</strong>
                    </h2>
                </span>
        </div>
        <div class="panel-body">
            Les champs marqués <code>(*)</code> sont obligatoires.<br/><br/>
            <button class="btn btn-info" data-toggle="modal" data-target="#modal_large">
                <i class="fa fa-plus-circle"></i>
            </button>
            <form method="post" action="" enctype="multipart/form-data">

                <label class="control-label">Titre<code>(*)</code> </label>
                <div class="form-group has-warning">

                    <input type="text" class="form-control" name="titre"/>
                </div>
                <label class="control-label">Mots Clés</label>
                <div class="form-group has-warning">

                    <input type="text" class="form-control" name="motcle"/>
                </div>

                <label class="control-label"></label>
                <div class="form-group">
                    <label class="col-md-2 control-label">Fichier:<code>(*)</code></label>
                    <div class="col-md-10">
                        <input type="file" class="file" name="fichier" data-filename-placement="inside"/>
                    </div>
                </div>


        </div>
        <div class="panel-footer">
            <input class="btn btn-success pull-right" type="submit" id="pc_refresh" value="Enregistrer" name="enregistrer">
            <input class="btn btn-default pull-left" type="reset"  value="Réinitialiser">
        </div>
        </form>
    </div>
    <div class="modal" id="modal_large" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 style="color: green; text-align: center" class="modal-title" id="largeModalHead">CREATION D'UNE NOUVELLE CATEGORIE </h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">

                        <form method="post" action="">
                            Libelle<code>(*)</code>
                            <input type="text" class="form-control" name="categorienew" value="<?php echo isset($categorie)? $categorie :'';?>"/><br/>

                            <input class="btn btn-success pull-left" type="submit"  value="Valider" name="enregistrerCate">
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>

                    </div>



                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
</div>
<?php
include_once("footer.php");
?>