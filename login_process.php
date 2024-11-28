<?php
session_start(); 
include('include/db.php');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $id_admin = isset($_POST['id_admin']) ? (int)$_POST['id_admin'] : null;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : null;

    try {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Stockez les données dans la session
            $_SESSION['id_admin'] = $user['id_admin'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            //var_dump($_SESSION['role']);
//exit();
            header("Location: index.php");
            exit();
        } else {
            // Redirigez avec un message d'erreur
            header("Location: login.php?error=Email ou mot de passe incorrect.");
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur, redirigez avec un message
        header("Location: login.php?error=Erreur interne. Réessayez plus tard.");
        exit();
    }
} else {
    header("Location: login.php?error=Veuillez remplir tous les champs.");
    exit();
}
?>