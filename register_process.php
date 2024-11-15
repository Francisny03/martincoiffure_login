<?php
session_start();
include('include/db.php'); // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier que les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "<p>Les mots de passe ne correspondent pas.</p>";
        exit();
    }

    // Vérifier si l'utilisateur existe déjà
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo "<p>Utilisateur déjà inscrit.</p>";
    } else {
        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO admin (email, password) VALUES (:email, :password)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);

        // Exécuter la requête et vérifier si l'utilisateur a été ajouté
        if ($stmt->execute()) {
            // Créer une session pour l'utilisateur
            $user_id = $conn->lastInsertId(); // Récupère l'ID de l'utilisateur nouvellement inscrit
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;

            // Rediriger vers la page d'accueil
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Erreur lors de l'inscription. Veuillez réessayer.</p>";
        }
    }
} else {
    echo "<p>Requête invalide.</p>";
}