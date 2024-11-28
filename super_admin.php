<?php
session_start();
include('include/header.php');
include('function/function.php');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Vérification de l'accès uniquement pour les admins
if (!isset($_SESSION['id_admin']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit(); // Redirection si l'utilisateur n'est pas un admin ou n'est pas connecté
}
?>

<span class="p5"></span>

<div class="bloc">
    <div class="slider">
        <div class="slider_image">
            <img src="image/slider_1.webp" alt="">
        </div>
        <div class="slider_filter flex">
            <div class="slider_filter_text">
                <p>Admin</p>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>


<div class="count_number_create flex width_margin">
    <div class="count_number flex">
        <p>Admin:</p>
        <p id="adminCount"></p>
    </div>
    <div class="create_new">
        <button type="submit" id="myBtn" class="button">Créer un admin</button>
    </div>
</div>
<br>
<br>

<div class="bloc_content width_margin">
    <div class="table-responsive">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Modifier</th>
                </tr>
            </thead>
            <tbody>
                <?php
            include('table_admindisplay.php')
            ?>
            </tbody>
        </table>
    </div>

</div>



<div class="popup" id="popup">


    <form action="action_admin.php" method="POST" enctype="multipart/form-data">
        <div class="popup_content" id="popup">
            <div class="create_new space_bottom">
                <p>Créer un admin</p>
            </div>
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom de l'admin</p>
                    <input type="text" placeholder="entrez le nom de l'admin..." name="name" required>
                </div>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Email</p>
                    <input type="text" placeholder="entrez le mail..." name="email" required>
                    <?php if (isset($_GET['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
                    <?php endif; ?>
                </div>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Mot de passe</p>
                    <input type="text" placeholder="entrez le mot de passe..." name="password" required>
                </div>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Confirmer le mot de passe</p>
                    <input type="text" placeholder="confirmer le mot de passe" name="confirm_password" required>
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Rôle</p>
                    <select id="role" name="role">
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                    <!-- <input type="text" placeholder="entrez le rôle..." name="role"> -->
                </div>
            </div>

            <div class="create_new space_top">
                <button type="submit" class="button">Créer un admin</button>
            </div>

            <button type="button" class="closePopupbtn flex" id="closePopupBtn">&times;</button>
        </div>
    </form>

</div>
<br>
<br>
<br>

<div class="popup" id="popupAdmin">
    <form action="update_admin.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_admin" id="adminId"> <!-- ID caché pour l'update -->
        <div class="popup_content" id="popup">
            <div class="create_new space_bottom">
                <p>Modifier un admin</p>
            </div>
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom de l'admin</p>
                    <input type="text" placeholder="entrez le nom de l'admin..." name="name" required>
                </div>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Email</p>
                    <input type="text" placeholder="entrez le mail..." name="email">
                    <?php if (isset($_GET['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
                    <?php endif; ?>
                </div>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Mot de passe</p>
                    <input type="text" placeholder="entrez le mot de passe..." name="password" required>
                </div>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Confirmer le mot de passe</p>
                    <input type="text" placeholder="confirmer le mot de passe" name="confirm_password" required>
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Rôle</p>
                    <select id="role" name="role">
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="button">Modifier l'admin</button>
                <button type="button" class="closePopupbtn flex" id="closePopupAdmin">&times;</button>

            </div>
        </div>

    </form>
</div>
<br>
<br>
<br>

<?php
include('include/footer.php')
?>