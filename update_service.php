<?php
header('Content-Type: application/json'); // Assure que la réponse est au format JSON
include('include/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = (int)$_POST["id"];
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $position = $_POST["position"];
    $uploadDir = 'image/';
    $image1 = null;
    $image2 = null;

    // Traitement de l'image1
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
        $image1_ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
        $image1_newName = uniqid() . "_image1." . $image1_ext;
        $image1_path = $uploadDir . $image1_newName;

        if (move_uploaded_file($_FILES['image1']['tmp_name'], $image1_path)) {
            $image1 = $image1_path;
        }
    } else {
        // Récupérer l'image actuelle si aucune nouvelle image n'est téléchargée
        $stmt_image1 = $conn->prepare("SELECT image1 FROM services WHERE id = :id");
        $stmt_image1->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_image1->execute();
        $image1 = $stmt_image1->fetchColumn();
    }

    // Traitement de l'image2
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $image2_ext = pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION);
        $image2_newName = uniqid() . "_image2." . $image2_ext;
        $image2_path = $uploadDir . $image2_newName;

        if (move_uploaded_file($_FILES['image2']['tmp_name'], $image2_path)) {
            $image2 = $image2_path;
        }
    } else {
        // Récupérer l'image actuelle si aucune nouvelle image n'est téléchargée
        $stmt_image2 = $conn->prepare("SELECT image2 FROM services WHERE id = :id");
        $stmt_image2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_image2->execute();
        $image2 = $stmt_image2->fetchColumn();
    }

    // Préparez la requête de mise à jour
    $stmt = $conn->prepare("UPDATE services SET titre = :titre, description = :description, position = :position, image1 = :image1, image2 = :image2 WHERE id = :id");
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':image1', $image1, PDO::PARAM_STR);
    $stmt->bindParam(':image2', $image2, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécutez la requête et redirigez ou affichez un message d'erreur
    if ($stmt->execute()) {
        header('Location: service.php');
        exit();
    } else {
        echo json_encode(["error" => "Erreur lors de la mise à jour du service."]);
    }
} else {
    echo json_encode(["error" => "Requête non valide (données manquantes)."]);
}
?>