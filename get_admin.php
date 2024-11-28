<?php
header('Content-Type: application/json'); // Assure que la réponse est au format JSON
include('include/db.php');

if (isset($_GET['id_admin'])) {
    $id_admin = (int)$_GET['id_admin'];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE id_admin = :id");
        $stmt->bindParam(':id', $id_admin, PDO::PARAM_INT);
        $stmt->execute();

        $get_admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($get_admin) {
            // Retourne les données du slider en JSON
            echo json_encode($get_admin);
            exit;
        } else {
            // Slider non trouvé
            $response['error'] = 'admin non trouvé';
        }
    } else {
        // Erreur de connexion
        $response['error'] = 'Connexion à la base de données échouée';
    }
} else {
    // ID manquant
    $response['error'] = 'ID de admin manquant';
}

// Envoie la réponse en JSON en cas d'erreur
echo json_encode($response);
exit;