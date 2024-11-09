<?php
header('Content-Type: application/json'); // Assure que la réponse est au format JSON
include('include/db.php');

if (isset($_GET['id_galerie'])) {
    $id_galerie = (int)$_GET['id_galerie'];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM galeries WHERE id_galerie = :id");
        $stmt->bindParam(':id', $id_galerie, PDO::PARAM_INT);
        $stmt->execute();

        $get_galerie = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($get_galerie) {
            // Retourne les données du slider en JSON
            echo json_encode($get_galerie);
            exit;
        } else {
            // Slider non trouvé
            $response['error'] = 'service non trouvé';
        }
    } else {
        // Erreur de connexion
        $response['error'] = 'Connexion à la base de données échouée';
    }
} else {
    // ID manquant
    $response['error'] = 'ID de service manquant';
}

// Envoie la réponse en JSON en cas d'erreur
echo json_encode($response);
exit;