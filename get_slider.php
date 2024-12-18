<?php
header('Content-Type: application/json'); // Assure que la réponse est au format JSON
include('include/db.php');

if (isset($_GET['id'])) {
    $id_slider = (int)$_GET['id'];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM slider WHERE id = :id");
        $stmt->bindParam(':id', $id_slider, PDO::PARAM_INT);
        $stmt->execute();

        $get_slider = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($get_slider) {
            // Retourne les données du slider en JSON
            echo json_encode($get_slider);
            exit;
        } else {
            // Slider non trouvé
            $response['error'] = 'Slider non trouvé';
        }
    } else {
        // Erreur de connexion
        $response['error'] = 'Connexion à la base de données échouée';
    }
} else {
    // ID manquant
    $response['error'] = 'ID de slider manquant';
}

// Envoie la réponse en JSON en cas d'erreur
echo json_encode($response);
exit;