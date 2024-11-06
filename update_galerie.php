<?php
header('Content-Type: application/json');

function getConn() {
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=martin_coiffure;charset=utf8", "root", "");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $PDO;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

$PDO = getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_galerie"])) {
    $id = (int)$_POST["id_galerie"];
    $titre = $_POST["titre"];
    $position = $_POST["position"];
    $uploadDir = 'image/';
    
    // Récupère les données actuelles
    $stmtCurrent = $PDO->prepare("SELECT image, images FROM galeries WHERE id_galerie = :id");
    $stmtCurrent->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCurrent->execute();
    $currentData = $stmtCurrent->fetch(PDO::FETCH_ASSOC);

    $galerie_img_principale = $currentData['image'];
    $galerie_imgs = json_decode($currentData['images'], true) ?: [];

    // Traitement de la nouvelle image principale
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_newName = uniqid() . "_image." . $image_ext;
        $galerie_img_principale = $uploadDir . $image_newName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $galerie_img_principale)) {
            $galerie_img_principale = $currentData['image']; // Garde l'image actuelle si erreur
        }
    }

    // Traitement des nouvelles images supplémentaires
    if (isset($_FILES['images'])) {
        $new_galerie_imgs = [];
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === 0) {
                $images_ext = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
                $images_newName = uniqid() . "_images_" . $key . "." . $images_ext;
                $imagePath = $uploadDir . $images_newName;

                if (move_uploaded_file($tmp_name, $imagePath)) {
                    $new_galerie_imgs[] = $imagePath;
                }
            }
        }

        // Fusionne les nouvelles images téléchargées avec les images actuelles
        $galerie_imgs = array_merge($galerie_imgs, $new_galerie_imgs);
    }

    $galerie_imgs_json = json_encode($galerie_imgs);

    // Préparez la requête de mise à jour
    $stmt = $PDO->prepare("UPDATE galeries SET titre = :titre, image = :image, images = :images, position = :position WHERE id_galerie = :id");
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':image', $galerie_img_principale, PDO::PARAM_STR);
    $stmt->bindParam(':images', $galerie_imgs_json, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: galerie.php');
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo json_encode(["error" => "Erreur lors de la mise à jour de la galerie.", "details" => $errorInfo]);
    }
} else {
    echo json_encode(["error" => "Requête non valide (données manquantes)."]);
}
?>