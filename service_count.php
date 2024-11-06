<?php
include('function/function.php'); // Incluez le fichier de connexion à la base de données
// Connexion à la base de données
$PDO = getConn();

// Requête pour compter les services
$req_count = "SELECT COUNT(*) AS total_services FROM services";
$stmt_count = $PDO->prepare($req_count);
$stmt_count->execute();
$total_services = $stmt_count->fetch(PDO::FETCH_ASSOC)['total_services'];

// Requête pour compter les sliders
$req_count_slider = "SELECT COUNT(*) AS total_slider FROM slider";
$stmt_count_slider = $PDO->prepare($req_count_slider);
$stmt_count_slider->execute();
$total_slider = $stmt_count_slider->fetch(PDO::FETCH_ASSOC)['total_slider'];

// Retourne les deux nombres au format JSON
echo json_encode(['total_services' => $total_services, 'total_slider' => $total_slider]);
?>
