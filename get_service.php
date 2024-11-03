<?php
header('Content-Type: application/json'); // Assure que la réponse est au format JSON
function getConn() {
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=martin_coiffure;charset=utf8", "root", "");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $PDO;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

$response = [];

// Appeler getConn pour obtenir l'instance PDO
$PDO = getConn();

if (isset($_GET['id'])) {
    $id_service = (int)$_GET['id'];

    if ($PDO) {
        $stmt = $PDO->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->bindParam(':id', $id_service, PDO::PARAM_INT);
        $stmt->execute();

        $get_service = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($get_service) {
            // Retourne les données du slider en JSON
            echo json_encode($get_service);
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