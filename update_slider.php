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

// Appeler getConn pour obtenir l'instance PDO
$PDO = getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = (int)$_POST["id"];
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $position = $_POST["position"];
    $uploadDir = 'image/';
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_newName = uniqid() . "_image." . $image_ext;
        $image_path = $uploadDir . $image_newName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = $image_path;
        }
    } else {
        // Si aucune nouvelle image n'est téléchargée, récupérez l'image actuelle
        $stmt = $PDO->prepare("SELECT image FROM slider WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetchColumn();
    }

    // Préparez la requête de mise à jour
    $stmt = $PDO->prepare("UPDATE slider SET titre = :titre, description = :description, position = :position,  image = :image WHERE id = :id");
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécutez la requête et redirigez ou affichez un message d'erreur
    if ($stmt->execute()) {
        header('Location: slider.php');
        exit();
    } else {
        echo json_encode(["error" => "Erreur lors de la mise à jour du slider."]);
    }
} else {
    echo json_encode(["error" => "Requête non valide (données manquantes)."]);
}
?>