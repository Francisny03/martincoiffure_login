<?php
include('include/header.php')
?>

<span class="p4"></span>

<div class="bloc">
    <div class="slider">
        <div class="slider_image">
            <img src="image/slider_1.webp" alt="">
        </div>
        <div class="slider_filter flex">
            <div class="slider_filter_text">
                <p>Galérie</p>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>

<div class="count_number_create flex width_margin">
    <div class="count_number flex">
        <p>Galérie:</p>
        <p>12</p>
    </div>
    <div class="create_new">
        <button type="submit" id="myBtn" class="button">Créer un album</button>
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
                <th>Image</th>
                <th>Autres images</th>
                <th>Position</th>
                <th>Plus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('table_galeriedisplay.php')
            ?>
        </tbody>
    </table>
</div>

<div class="popup" id="popup">
    <form action="action_galerie.php" method="POST" enctype="multipart/form-data">
        <div class="popup_content" id="popup">
            <div class="create_new space_bottom">
                <p>Créer un album</p>
            </div>
            <div class="popup_content_items space_padding">
                <div class="create_items">
                    <p class="space_padding_left">Nom de l'album</p>
                    <input type="text" placeholder="Entrez le nom du service..." name="titre" required>
                </div>
                <br><br>
                <div class="create_items">
                    <p class="space_padding_left">Uploader l'image principale</p>
                    <input type="file" name="image" required>
                </div>
                <div class="create_items">
                    <p class="space_padding_left">Uploader les images supplémentaires</p>
                    <input type="file" name="images[]" multiple>
                </div>
            </div>

            <div class="create_new space_top">
                <button type="submit" class="button">Créer un album</button>
            </div>

            <button type="button" class="closePopupbtn flex" id="closePopupBtn">&times;</button>
        </div>
    </form>

</div>
<br>
<br>
<br>


<?php
include('include/footer.php')
?>