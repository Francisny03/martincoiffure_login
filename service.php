<?php
session_start();
include('include/header.php');
include('function/function.php');
deconnexionSession();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['user_email'];
?>

<span class="p2"></span>

<div class="bloc">
    <div class="slider">
        <div class="slider_image">
            <img src="image/slider_1.webp" alt="">
        </div>
        <div class="slider_filter flex">
            <div class="slider_filter_text">
                <p>Services</p>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>

<div class="count_number_create flex width_margin">
    <div class="count_number flex">
        <p>Services:</p>
        <p id="serviceCount"></p>
    </div>
    <div class="create_new">
        <button type="submit" id="myBtn" class="button">Créer un service</button>
    </div>
</div>
<br>
<br>

<div class="bloc_content width_margin">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Photo avant</th>
                <th>Photo arrière</th>
                <th>Position</th>
                <th>Plus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('table_servicedisplay.php')
            ?>
        </tbody>
    </table>
</div>

<div class="popup" id="popup">
    <form action="action_service.php" method="POST" enctype="multipart/form-data">
        <div class="popup_content" id="popup">
            <div class="create_new space_bottom">
                <p>Créer un service</p>
            </div>
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom du service</p>
                    <input type="text" placeholder="entrez le nom du service..." name="titre">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Description du service</p>
                    <input type="text" placeholder="entrez la description du service..." name="description">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Position</p>
                    <input type="text" placeholder="entrez la position du service..." name="position">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Uploader la photo avant</p>
                    <input type="file" placeholder="aucun fichier n'a été sélectionné" name="image1">
                </div>
                <div class="create_items">
                    <p class="space_padding_left">Uploader la photo arrière</p>
                    <input type="file" placeholder="aucun fichier n'a été sélectionné" name="image2">
                </div>
            </div>

            <div class="create_new space_top">
                <button type="submit" class="button">Créer un service</button>
            </div>

            <button type="button" class="closePopupbtn flex" id="closePopupBtn">&times;</button>
        </div>
    </form>

</div>
<br>
<br>
<br>

<div class="popup" id="popupService">
    <form action="update_service.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="serviceId"> <!-- ID caché pour l'update -->
        <div class="popup_content" id="popup">
            <div class="create_new space_bottom">
                <p>Modifier un service</p>
            </div>
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom du service</p>
                    <input type="text" placeholder="entrez le nom du service..." name="titre">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Description du service</p>
                    <input type="text" placeholder="entrez la description du service..." name="description">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Position</p>
                    <input type="text" placeholder="entrez la position du service..." name="position">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Uploader la photo avant</p>
                    <input type="file" placeholder="aucun fichier n'a été sélectionné" name="image1">
                </div>
                <div class="create_items">
                    <p class="space_padding_left">Uploader la photo arrière</p>
                    <input type="file" placeholder="aucun fichier n'a été sélectionné" name="image2">
                </div>
            </div>

            <div class="create_new space_top">
                <button type="submit" class="button">Modifier un service</button>
            </div>

            <button type="button" class="closePopupbtn flex" id="closeServiceModifierBtn">&times;</button>
        </div>
    </form>

</div>
<br>
<br>
<br>

<?php
include('include/footer.php')
?>