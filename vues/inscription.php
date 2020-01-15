
<?php
include_once("entete.php");
include_once("menu.php");
?>
<?php
//include_once("entete.php");
include_once("menu.php");
?>
<?php
$mes="";

if(isset($_POST['enregistrer'])){

    $nom= htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $matricule = htmlspecialchars($_POST['matricule']);
    $profession = htmlspecialchars($_POST['profession']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $fil_tmp=$_FILES['photo']['tmp_name'];
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $nomdufichier=$_FILES['photo']['name'];
    $extensions=array('jpg','jpeg','png');
    //$extension = strrchr($_FILES['photo']['name'], '.');
    $extension_upload = strtolower(  substr(  strrchr($nomdufichier, '.')  ,1) );
    echo "-----------------------------------".$sexe;
//Ensuite on teste
    if(!in_array($extension_upload,$extensions)) //Si l'extension n'est pas dans le tableau
    {
        $mes= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Vous devez uploader un fichier de type jpg,jpep ou png</p>"
            . "</div>";
    }elseif(empty($nom)){
        $mesNom= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Veuillez renseigner le nom SVP</p>"
            . "</div>";
    }elseif(empty($matricule)){
        $mesMatri= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Veuillez renseigner le Matricule SVP</p>"
            . "</div>";
    }elseif(empty($profession)){
        $mesPro= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Veuillez renseigner la Profession SVP</p>"
            . "</div>";
    }elseif($sexe=='null'){
        $mesSexe= "<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Veuillez selectionner la situation matrimoniale SVP</p>"
            . "</div>";
    }


    else{
        $id_derniere_ass=Doctrine_Query::create()->select('Max(id) as id_ass')->from('Acteur')
            ->execute(array(),Doctrine::HYDRATE_RECORD);
        $id_acteur= $id_derniere_ass[0]['id_ass'];
        $password=md5(1234);
        $image =($id_acteur+1).".".$extension_upload ;
        $donneur =  new Acteur();
        $donneur->set('nom', $nom);
        $donneur->set('prenom', $prenom);
        $donneur->set('matricule', $matricule);
        $donneur->set('fonction', $profession);
        $donneur->set('datenaissance', $date_naissance);
        $donneur->set('photo', $image);
        $donneur->set('telephone', $telephone);
        $donneur->set('login', $prenom);
        $donneur->set('password', $password);
        $donneur->set('sexe', $sexe);
        move_uploaded_file($fil_tmp, "dossier/$image");
        $donneur->save();
    }


    echo "------------------------------------------------------------------".$extension_upload;

}

?>

    <div class="col-md-6 col-md-offset-2">

        <?php  echo $mes; ?>
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #4a8cdb;">
                <span>
                    <h2 class="panel-title" style="color: #ffffff; margin-left: 10px">
                        <i class="fa fa fa-user"></i>
                        <strong>FORMULAIRE D'INCRIPTION D'UN AGENT</strong>
                    </h2>
                </span>
            </div>
            <div class="panel-body">
                Les champs marqués <code>(*)</code> sont obligatoires.<br/><br/>
                <form method="post" action="" enctype="multipart/form-data">


                    <label class="control-label">MATRICULE<code>(*)</code></label>
                    <div class="form-group has-warning">

                        <input type="text" class="form-control" name="matricule" value="<?php echo isset($matricule)? $matricule :'';?>" autocomplete="name"/>
                        <?php if(isset($_POST['enregistrer']) and empty($nom)){
                            echo "<div style='color: red'>veuillez entrer le numéro matricule SVP!</div>"
                            ;                                            }
                        ?>
                    </div>

                    <label class="control-label">NOM<code>(*)</code></label>
                    <div class="form-group has-warning">

                        <input type="text" class="form-control" name="nom" value="<?php echo isset($nom)? $nom :'';?>"/>
                        <?php if(isset($_POST['enregistrer']) and empty($nom)){
                            echo "<div style='color: red'>veuillez entrer votre nom SVP!</div>"
                            ;                                            }
                        ?>
                    </div>


                <label class="control-label">PRENOM(S)</label>
                    <div class="form-group has-warning">

                        <input type="text" class="form-control" name="prenom" value="<?php echo isset($prenom)? $prenom :'';?>"/>

                    </div>
					
                    <div class="form-group">
                        <label class="control-label" >SEXE</label>

                        <select class="form-control" name="sexe">
                            <option value="null">-----Selection-------</option>
                            <option value="Masculin">Masculin</option>
                            <option value="Feminin">Féminin</option>


                        </select>
                        <?php if(isset($sexe) and $sexe==0){
                            echo $sexe."<div style='color: red'>veuillez selectionner le genre SVP!!</div>"
                            ;                                            }
                        ?>
                    </div>



                    <label class="control-label">FONCTION</label>
                    <div class="form-group has-warning">

                        <input type="text" class="form-control" name="profession" value="<?php echo isset($profession)? $profession :'';?>"/>
                    </div>
                    <label class="control-label">DATE DE NAISSANCE<code>(*)</code></label>
                    <div class="form-group has-warning">

                        <input type="date" class="form-control" name="date_naissance" value="<?php echo isset($date_naissance)? $date_naissance :'';?>"/>
                        <?php if(isset($_POST['enregistrer']) and empty($date_naissance)){
                            echo "<div style='color: red'>veuillez entrer la date de naissance SVP!</div>"
                            ;                                            }
                        ?>
                    </div>

                    <label class="control-label">TELEPHONE<code>(*)</code></label>
                    <div class="form-group has-warning">

                        <input type="text" class="form-control" name="telephone" value="<?php echo isset($telephone)? $telephone :'';?>"/>
                        <?php if(isset($_POST['enregistrer']) and empty($telephone)){
                            echo "<div style='color: red'>veuillez entrer le numero telephone SVP!</div>"
                            ;                                            }
                        ?>
                    </div>



                    <label class="control-label">EMAIL</label>
                    <div class="form-group has-warning">

                        <input type="email" class="form-control" name="email" value="<?php echo isset($email)? $email :'';?>"/>
                        <?php if(isset($_POST['enregistrer']) and empty($email)){
                            echo "<div style='color: red'>veuillez entrer l'adresse email SVP!</div>"
                            ;                                            }
                        ?>
                    </div>

                    <label class="control-label"></label>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Photo:</label>
                        <div class="col-md-10">
                            <input type="file" class="file" name="photo"/>
                        </div>
                    </div>


                </div>
            <div class="panel-footer">
                <input class="btn btn-success pull-right" type="submit" id="pc_refresh" value="Enregistrer" name="enregistrer">
                <input class="btn btn-default pull-left" type="reset"  value="Réinitialiser">
            </div>
            </form>
            </div>

        </div>
<?php
include_once("footer.php");
?>