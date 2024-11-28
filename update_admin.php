<?php
header('Content-Type: application/json'); // Assure que la réponse est au format JSON
include('include/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_admin"])) {
    $id_admin = (int)$_POST["id_admin"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST["role"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Insertion des données dans la base de données
        if ($password !== $confirm_password) {
                                 echo "<p>Les mots de passe ne correspondent pas.</p>";
            exit();
        }

    // Préparez la requête de mise à jour
    $stmt = $conn->prepare("UPDATE admin SET name = :name, email = :email, password = :password, role = :role WHERE id_admin = :id_admin");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);

    // Exécutez la requête et redirigez ou affichez un message d'erreur
    if ($stmt->execute()) {
        header('Location: super_admin.php');
        exit();
    } else {
        echo json_encode(["error" => "Erreur lors de la mise à jour du service."]);
    }
} else {
    echo json_encode(["error" => "Requête non valide (données manquantes)."]);
}
?>