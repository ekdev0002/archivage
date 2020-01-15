<?php
session_start();
if(!isset($_SESSION['profil'])){
    header("location: ../index.php");
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <!-- META SECTION -->
    <title>Archivage</title>
    <link rel="icon" href="../assets/images/panel2.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="../css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>