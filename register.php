<?php
include('include/couverture_header.php')
?>


<div class="admin_page">
    <div class="container flex">
        <div class="left_section rect_width flex">
            <div class="left_section_items">
                <center>
                    <h2><b>Inscription</b></h2>
                </center>
                <div class="connexion_items">
                    <p class="space_bottom">Ajoutez vos informations pour accéder au dashboard</>
                    <form action="register_process.php" method="POST">
                        <div class="username input_login flex">
                            <img src="image/username.svg" alt="">
                            <input type="email" placeholder="adresse mail" name="email" required>
                        </div>
                        <div class="password input_login flex">
                            <img src="image/password.svg" alt="">
                            <input type="password" placeholder="mot de passe" name="password" required>
                        </div>
                        <div class="password input_login flex">
                            <img src="image/password.svg" alt="">
                            <input type="password" placeholder="confirmer le mot de passe" name="confirm_password"
                                required>
                        </div>
                        <button type="submit" class="input_login space_top">Se connecter</button>
                    </form>
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
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
                        type="module"></script>
                    <dotlottie-player src="https://lottie.host/5da4536c-cf10-425d-9eec-a4ef32fdd90c/YB466HnZBv.json"
                        background="transparent" speed="2" loop autoplay>
                    </dotlottie-player>
                    <!-- <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
                        type="module"></script>

                    <dotlottie-player src="https://lottie.host/43015b01-1af5-4f03-9fce-bdfe5f66783b/TeNpzLpuz4.json"
                        background="transparent" speed="1" loop autoplay>
                    </dotlottie-player> -->
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
?>









<!-- <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

<dotlottie-player src="" background="none" speed="1" style="width: 300px; height: 300px;" loop autoplay>
</dotlottie-player> -->