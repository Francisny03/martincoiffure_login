<?php
session_start();
include('include/db.php');

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id_admin, password FROM admin WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifie le mot de passe
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id_admin']; // Enregistre l'ID admin dans la session
                $_SESSION['user_email'] = $user['email']; // Enregistre l'email dans la session
                header("Location: index.php"); // Redirige vers l'index
                exit();
            } else {
                echo "<p>Mot de passe incorrect.</p>";
            }
        } else {
            echo "<p>Adresse e-mail incorrecte.</p>";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
} else {
    echo "<p>Veuillez entrer un email et un mot de passe.</p>";
}