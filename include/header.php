<?php
include('couverture_header.php');
include('include/db.php');

// Vérification seulement sur certaines pages
$restricted_pages = ['super_admin.php']; // Liste des pages nécessitant une session valide et un rôle d'admin

// Vérifiez si l'utilisateur est sur une page protégée
if (in_array(basename($_SERVER['PHP_SELF']), $restricted_pages)) {
    // Si l'utilisateur n'est pas connecté ou son rôle n'est pas admin, redirigez-le
    if (!isset($_SESSION['id_admin']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php");
        exit(); // Redirection si l'utilisateur n'est pas un admin ou n'est pas connecté
    }
}

// Check if the 'role' session variable exists
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>


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
            <?php if ($role === "admin"): ?>
            <div class="lien p5 space_letter"><a href="super_admin.php">Admin</a></div>
            <?php endif; ?>
            <br>
            <br>
            <div class="lien p6 space_letter"><a href="login.php">Se déconnecter</a></div>
        </div>
    </div>

    <div class="main">