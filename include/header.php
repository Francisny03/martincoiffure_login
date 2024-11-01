<?php
include('function/function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon 2  -->
    <link rel="apple-touch-icon" sizes="180x180" href="image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon/favicon-16x16.png">
    <link rel="manifest" href="image/favicon/site.webmanifest">
    <link rel="mask-icon" href="image/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Table Boostrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!-- mystyle -->
    <link rel="stylesheet" href="SCSS/style.scss?<?= rand() ?>">

    <!-- js bootstrap -->

    <title>Martin Coiffure Dashboard</title>
</head>

<body>
    <div class="menu_bar">
        <br>
        <div class="menu_logo">
            <img src="image/logo_martin.png" alt="">
        </div>
        <br><br>

        <div class="liens">
            <div class="lien p1 space_letter"><a href="index.php">Accueil</a></div>
            <div class="lien p2 space_letter"><a href="service.php">Services</a></div>
            <div class="lien p3 space_letter"><a href="slider.php">Slider</a></div>
            <div class="lien p4 space_letter"><a href="galerie.php">Galérie</a></div>
        </div>
    </div>

    <div class="main">