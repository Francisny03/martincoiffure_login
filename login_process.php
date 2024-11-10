<?php
session_start();
include('include/db.php');

// Vérifier si l'email et le mot de passe sont bien envoyés via POST
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe dans la base de données
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe en clair correspond
    if ($user && $password === $user['password']) {
        // Connexion réussie : création de la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        
        // Redirection vers la page d'accueil
        header("Location: index.php");
        exit();
    } else {
        // Erreur : email ou mot de passe incorrect
        echo "<p>Email ou mot de passe incorrect.</p>";
    }
} else {
    echo "<p>Veuillez entrer un email et un mot de passe.</p>";
}

