<?php
session_start();
if(isset($_SESSION['profil'])){
    header("location: ./vues/index.php");
}
require_once './librairies/doctrine/config/global.php';

$mes="";
if(isset($_POST['seconnecter'])){
    $txtlogin = htmlspecialchars($_POST['username']);
    $txtpassword = htmlspecialchars($_POST['password']);



    if(empty($txtlogin)){
        $mes="<div  class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Echec de connexion; Veuillez inserer un login</p>"
            . "</div>";
    }
    elseif(empty($txtpassword)){
        $mes="<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Echec de connexion; Veuillez inserer un mot de passe</p>"
            . "</div>";
    }
    elseif(empty($txtpassword) and empty($txtlogin)){
        $mes="<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
            . "<p>Echec de connexion; Veuillez inserer un login et un mot de passe</p>"
            . "</div>";
    }else{
        $password=md5($txtpassword);
        $acteur=Doctrine_Core::getTable("Acteur");
        echo $txtlogin." et ".$txtpassword." ".$password;
        $util=$acteur->findOneByPasswordAndLogin($password, $txtlogin);

        //echo $util->nom;

        if($util){

            $_SESSION['profil']=$util['id_profil'];
            $_SESSION['identifiant']=$util['id'];
            $_SESSION['nom']=$util['nom'];
            $_SESSION['prenom']=$util['prenom'];
            $_SESSION['photo']=$util['photo'];

            //$_SESSION['section']=$util['section'];


           header("location: ./vues/index.php");
			$mes= "bonne connexion";

        }
        else{
            $mes="<div class='alert alert-danger' style='margin-top:10px;text-align:center;'>"
                . "<p>Echec de connexion; login ou mot de passe incorrects</p>"
                . "</div>";
        }
    }



}

?><!DOCTYPE html>
<html lang="fr" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Web Archive</title>
        <link rel="icon" href="assets/images/log.jpg">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->

                  <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>



    </head>
    <body>

        <div class="login-container">

            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"> <center>Web Archive</center></div>
                    <?php echo $mes; ?>
                <form action="" class="form-horizontal" method="post" style="display:block" id="form_con">

                    <div class="form-group">
                            <div class="col-md-12">
                                    <div class="input-group" >
                                     <input type="text" class="form-control textstyle" name="username" placeholder="Login" value="<?php echo isset($txtlogin)? $txtlogin :'';?>" />
                                                <span class="input-group-addon" style="background:white"><span class="fa fa-user text text-primary"></span></span>
                                   </div>
                            </div>
                     </div>

                    <div class="form-group">
                             <div class="col-md-12">
                                    <div class="input-group" >
                                     <input type="password" class="form-control textstyle" name="password"  placeholder="Mot de passe"/>
                                        <span class="input-group-addon add-on " style="background:white"><span class="fa fa-lock text text-primary"></span></span>
                                    </div>
                             </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-4">
                               <a href="#" class="btn btn-link btn-block"  id=""> <i class="ace-icon fa fa-arrow-left" ></i>   Pwd Oublié?</a>
                        </div>
                        <div class="col-md-7">
                            <button class="btn btn-info btn-block" type="submit" name="seconnecter"> <i class="ace-icon fa fa-key"></i>Se Connecter </button>
                        </div>

                    </div>

                <div class="checkbox">
                          <label>
                        <input type="checkbox" value="1"> <span style="color: #ffffff">Se Souvenir de moi</span>
                        </label>
                     </div>
                    </form>


                </div>

            </div>

        </div>



        <script type="text/javascript">

        </script>

    </body>
</html>
