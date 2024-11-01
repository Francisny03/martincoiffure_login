<?php
include('include/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $services_name = $_POST["titre"];
    $services_st = $_POST["description"];
    $position_service = $_POST["position"];
    $uploadDir = 'image/';

    // Vérifier et traiter la première image
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] == 0) {
        $image1_ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
        $image1_newName = uniqid() . "_image1." . $image1_ext;
        $services_img1 = $uploadDir . $image1_newName;

        if (move_uploaded_file($_FILES['image1']['tmp_name'], $services_img1)) {
            echo "Image 1 téléchargée avec succès.<br>";
        } else {
            echo "Erreur lors du téléchargement de l'image 1.<br>";
        }
    }

    // Vérifier et traiter la deuxième image
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] == 0) {
        $image2_ext = pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION);
        $image2_newName = uniqid() . "_image2." . $image2_ext;
        $services_img2 = $uploadDir . $image2_newName;

        if (move_uploaded_file($_FILES['image2']['tmp_name'], $services_img2)) {
            echo "Image 2 téléchargée avec succès.<br>";
        } else {
            echo "Erreur lors du téléchargement de l'image 2.<br>";
        }
    }

    // Insertion des données dans la base de données
    try {
        $stmt = getConn()->prepare("INSERT INTO services (titre, description, image1, image2, position) VALUES (:titre, :description, :image1, :image2, :position)");
        $stmt->bindParam(':titre', $services_name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $services_st, PDO::PARAM_STR);
        $stmt->bindParam(':image1', $services_img1, PDO::PARAM_STR);
        $stmt->bindParam(':image2', $services_img2, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position_service, PDO::PARAM_STR);


        if ($stmt->execute()) {
            // Redirection après succès de l'enregistrement
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