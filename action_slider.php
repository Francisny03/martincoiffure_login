<?php
include('include/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $slider_name = $_POST["titre"];
    $slider_st = $_POST["description"];
    $position_slider = $_POST["position"];
    $uploadDir = 'image/';

    // Vérifier et traiter la première image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_newName = uniqid() . "_image." . $image_ext;
        $services_img = $uploadDir . $image_newName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $services_img)) {
            echo "Image  téléchargée avec succès.<br>";
        } else {
            echo "Erreur lors du téléchargement de l'image.<br>";
        }
    }

    // Insertion des données dans la base de données
    try {
        $stmt = getConn()->prepare("INSERT INTO slider (titre, description, image, position) VALUES (:titre, :description, :image, :position)");
        $stmt->bindParam(':titre', $slider_name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $slider_st, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position_slider, PDO::PARAM_STR);
        $stmt->bindParam(':image', $services_img, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header('Location:slider.php');
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