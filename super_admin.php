<?php
include('include/header.php');
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
        <button type="submit" id="myBtn" class="button">Créer un slider</button>
    </div>
</div>
<br>
<br>

<div class="bloc_content width_margin">
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



<div class="popup" id="popup">
    <form action="action_slider.php" method="POST" enctype="multipart/form-data">
        <div class="popup_content" id="popup">
            <div class="create_new space_bottom">
                <p>Créer un slider</p>
            </div>
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom du slider</p>
                    <input type="text" placeholder="entrez le nom du service..." name="titre">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Description du slider</p>
                    <input type="text" placeholder="entrez la description du service..." name="description">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Position</p>
                    <input type="text" placeholder="entrez la position du slider..." name="position">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Uploader la photo</p>
                    <input type="file" placeholder="aucun fichier n'a été sélectionné" name="image">
                </div>
            </div>

            <div class="create_new space_top">
                <button type="submit" class="button">Créer un slider</button>
            </div>

            <button type="button" class="closePopupbtn flex" id="closePopupBtn">&times;</button>
        </div>
    </form>

</div>
<br>
<br>
<br>

<div class="popup" id="popupSlider">
    <form action="update_slider.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="sliderId"> <!-- ID caché pour l'update -->
        <div class="popup_content" id="popup">
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom du slider</p>
                    <input type="text" placeholder="Entrez le titre..." name="titre">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Description du slider</p>
                    <input type="text" placeholder="Entrez le sous-titre..." name="description">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Position</p>
                    <input type="text" placeholder="entrez la position du slider..." name="position">
                </div>
                <br>
                <br>
                <div class="create_items">
                    <p class="space_padding_left">Uploader la photo</p>
                    <input type="file" name="image">
                </div>
                <br>
                <br>
                <button type="submit" class="button">Modifier le slider</button>
                <button type="button" class="closePopupbtn flex" id="closePopupSlider">&times;</button>

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