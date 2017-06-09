<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <title>ENSICafé</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <?php
    include('navigation.php');
    ?>

    <!-- Wrapper : contenu principal de la page -->
    <div id="wrapper">

        <?php
        include('sidebar.php');
        ?>

        <!-- Page Content : tout le contenu principal à mettre ici -->
        <div id="page-content-wrapper">