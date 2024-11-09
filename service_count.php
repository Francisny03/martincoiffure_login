<?php
include('include/db.php'); // Incluez le fichier de connexion à la base de données

// Requête pour compter les services
$req_count = "SELECT COUNT(*) AS total_services FROM services";
$stmt_count = $conn->prepare($req_count);
$stmt_count->execute();
$total_services = $stmt_count->fetch(PDO::FETCH_ASSOC)['total_services'];

// Requête pour compter les sliders
$req_count_slider = "SELECT COUNT(*) AS total_slider FROM slider";
$stmt_count_slider = $conn->prepare($req_count_slider);
$stmt_count_slider->execute();
$total_slider = $stmt_count_slider->fetch(PDO::FETCH_ASSOC)['total_slider'];


// Requête pour compter les images
$req_count_galerie = "SELECT COUNT(*) AS total_images FROM galeries";
$stmt_count_galerie = $conn->prepare($req_count_galerie);
$stmt_count_galerie->execute();
$total_images = $stmt_count_galerie->fetch(PDO::FETCH_ASSOC)['total_images'];

// Retourne les trois nombres au format JSON
echo json_encode(['total_services' => $total_services, 'total_slider' => $total_slider, 'total_images' => $total_images]);
?>