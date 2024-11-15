<?php
session_start();
include('include/db.php');
include('include/couverture_header.php');

// Initialiser une variable pour le message d'erreur
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $stmt = $conn->prepare("SELECT id_admin, password FROM admin WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Créer une nouvelle session pour l'utilisateur
                    session_regenerate_id(true);
                    $_SESSION['id_admin'] = $user['id_admin'];
                    $_SESSION['user_email'] = $email;

                    // Redirection vers la page d'accueil
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Mot de passe incorrect.";
                }
            } else {
                $error = "Utilisateur non inscrit.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez entrer un email et un mot de passe.";
    }
}
?>


<div class="admin_page">
    <div class="container flex">
        <div class="left_section rect_width flex">
            <div class="left_section_items">
                <center>
                    <h2><b>Connexion</b></h2>
                </center>
                <div class="connexion_items">
                    <p class="space_bottom">Merci de renseigner vos informations</p>
                    <?php if (isset($_GET['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                        <div class="username input_login flex">
                            <img src="image/username.svg" alt="">
                            <input type="email" placeholder="adresse mail" name="email" required>
                        </div>
                        <div class="password input_login flex">
                            <img src="image/password.svg" alt="">
                            <input type="password" placeholder="mot de passe" name="password" required>
                        </div>
                        <button type="submit" class="input_login space_top">Se connecter</button>
                    </form>
                    <a href="recovering_password.php">
                        <h7 class="forget_password">Mot de passe oublié ?</h7>
                    </a>
                </div>
            </div>



            <div class="admin_page">
                <div class="container flex">
                    <div class="left_section rect_width flex">
                        <div class="left_section_items">
                            <center>
                                <h2><b>Connexion</b></h2>
                            </center>
                            <div class="connexion_items">
                                <p class="space_bottom">Merci de renseigner vos informations</p>
                                <?php if (isset($error)): ?>
                                <p style="color: red;"><?= $error ?></p>
                                <?php endif; ?> <form action="login.php" method="POST">
                                    <div class="username input_login flex">
                                        <img src="image/username.svg" alt="">
                                        <input type="email" placeholder="adresse mail" name="email" required>
                                    </div>
                                    <div class="password input_login flex">
                                        <img src="image/password.svg" alt="">
                                        <input type="password" placeholder="mot de passe" name="password" required>
                                    </div>
                                    <button type="submit" class="input_login space_top">Se connecter</button>
                                </form>
                                <a href="recovering_password.php">
                                    <h7 class="forget_password">Mot de passe oublié ?</h7>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="right_section rect_width flex">
                        <div class="right_section_items">
                            <div class="right_section_img">
                                <img src="image/rect_image_coiffure.png" alt="">
                            </div>
                            <div class="lottie_rect">
                                <div class="lottie_logo">
                                    <img src="image/logo_martin.png" alt="">
                                </div>
                            </div>
                            <div class="lottie">
                                <script
                                    src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
                                    type="module"></script>
                                <dotlottie-player
                                    src="https://lottie.host/5da4536c-cf10-425d-9eec-a4ef32fdd90c/YB466HnZBv.json"
                                    background="transparent" speed="2" loop autoplay></dotlottie-player>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('include/footer.php'); ?>