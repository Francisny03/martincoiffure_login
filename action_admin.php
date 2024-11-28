<?php
include('include/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = $_POST["name"];
    $admin_email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST["role"];

    // Vérifier si l'utilisateur existe déjà
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $existingMail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingMail) {
        echo "<p>Le mail existe déjà.</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Insertion des données dans la base de données
        if ($password !== $confirm_password) {
                                 echo "<p>Les mots de passe ne correspondent pas.</p>";
            exit();
        }
        $stmt = $conn->prepare("INSERT INTO admin (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $stmt->bindParam(':name', $admin_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $admin_email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header('Location:super_admin.php');
            exit();
        } else {
                            echo "Erreur lors de l'enregistrement dans la base de données";
        }
    }
} else {
    echo "Requête non valide (RNF)";
}
?>