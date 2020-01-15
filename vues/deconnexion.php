<?php

session_start();
if(isset($_SESSION['profil'])){
    session_destroy();
}
header("location: ../index.php");
?>