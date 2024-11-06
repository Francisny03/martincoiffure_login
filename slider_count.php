<?php
include('function/function.php'); // Incluez le fichier de connexion à la base de données
// Connexion à la base de données
$PDO = getConn();
?>

<?php
// Requête pour compter les services
$req_count_slider = "SELECT COUNT(*) AS total_slider FROM slider";
$stmt_count_slider = $PDO->prepare($req_count);
$stmt_count_slider->execute();
$total_slider = $stmt_count_slider->fetch(PDO::FETCH_ASSOC)['total_slider'];

// Retourne le nombre de services au format JSON
echo json_encode(['total_slider' => $total_slider]);
?>
