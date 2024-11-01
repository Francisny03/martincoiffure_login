<?php
include('include/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $galerie_name = $_POST["titre"];
    $uploadDir = 'image/';
    $services_imgs = []; // Initialize the variable to avoid "undefined variable" error
    $services_imgs_json = json_encode($services_imgs);

    // Traitement de l'image principale
    $services_img = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_newName = uniqid() . "_image." . $image_ext;
        $services_img = $uploadDir . $image_newName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $services_img)) {
            echo "Erreur lors du téléchargement de l'image principale.<br>";
        }
    }

    // Traitement des images supplémentaires
    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === 0) {
                $images_ext = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
                $images_newName = uniqid() . "_images_" . $key . "." . $images_ext;
                $imagePath = $uploadDir . $images_newName;

                if (move_uploaded_file($tmp_name, $imagePath)) {
                    $services_imgs[] = $imagePath;
                } else {
                    echo "Erreur lors du téléchargement de l'image supplémentaire n°" . ($key + 1) . ".<br>";
                }
            }
        }
    }

    // Convert the array of additional images to JSON format
    $services_imgs_json = json_encode($services_imgs);

    // Insertion dans la base de données
    try {
        $stmt = getConn()->prepare("INSERT INTO galeries (titre, image, images) VALUES (:titre, :image, :images)");
        $stmt->bindParam(':titre', $galerie_name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $services_img, PDO::PARAM_STR);
        $stmt->bindParam(':images', $services_imgs_json, PDO::PARAM_STR);
       
        if ($stmt->execute()) {
            header('Location:service.php');
        exit();
        } else {
            echo "Erreur lors de l'enregistrement dans la base de données";
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
} else {
    echo "Requête non valide (RNF)";
}
?>