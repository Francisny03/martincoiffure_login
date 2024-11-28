console.log("TEST 4");

$(document).ready(function () {
    console.log('Initializing DataTable');
    new DataTable('#example');

    // Active state for spans
    $('span[class^="p"]').each(function () {
        var spanClass = $(this).attr('class');
        $('.liens .' + spanClass).addClass('active').removeClass(spanClass);
    });

    // Open the create popup
    $("#myBtn").on("click", function () {
        $("#popup").show();
    });

    // Close the create popup
    $("#closePopupBtn").on("click", function () {
        $("#popup").hide();
    });

    // Configure DataTable with descending order
    $('#example').DataTable({
        "order": [[0, "desc"]],
        "destroy": true
    });

    // Handle "Modifier" button clicks with AJAX
    $(".voirPlusBtn").each(function () {
        $(this).on("click", function () {
            var sliderId = $(this).data("id");

            // Fetch slider data with AJAX
            $.ajax({
                url: "get_slider.php",
                method: "GET",
                data: { id: sliderId },
                dataType: "json",
                success: function (data) {
                    if (data.error) {
                        console.log(data.error);
                        alert(data.error);
                    } else {
                        // Populate popup fields with the received data
                        $('#popupSlider input[name="titre"]').val(data.titre);
                        $('#popupSlider input[name="description"]').val(data.description);
                        $('#popupSlider input[name="id"]').val(data.id);
                        $('#popupSlider input[name="position"]').val(data.position);
                        $("#popupSlider").show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Data loading error: ", error);
                    alert("Une erreur s'est produite lors du chargement des données.");
                }
            });
        });
        document.getElementById('closePopupSlider').addEventListener('click', function () {
            document.getElementById('popupSlider').style.display = 'none';
        });
    });


    $(".modifier_service").each(function () {
        $(this).on("click", function () {
            var serviceId = $(this).data("id");

            // Fetch slider data with AJAX
            $.ajax({
                url: "get_service.php",
                method: "GET",
                data: { id: serviceId },
                dataType: "json",
                success: function (data) {
                    if (data.error) {
                        console.log(data.error);
                        alert(data.error);
                    } else {
                        // Populate popup fields with the received data
                        $('#popupService input[name="titre"]').val(data.titre);
                        $('#popupService input[name="description"]').val(data.description);
                        $('#popupService input[name="position"]').val(data.position);
                        $('#popupService input[name="id"]').val(data.id);
                        $("#popupService").show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Data loading error: ", error);
                    alert("Une erreur s'est produite lors du chargement des données.");
                }
            });
        });
        document.getElementById('closeServiceModifierBtn').addEventListener('click', function () {
            document.getElementById('popupService').style.display = 'none';
        });
    });

    $(".modifier_admin").each(function () {
        console.log("Initialisation de .modifier_admin");

        $(this).on("click", function () {
            console.log("Clique détecté sur .modifier_admin");

            var adminId = $(this).data("id_admin"); // Vérifie si 'id_admin' est défini
            console.log("ID admin récupéré");

            if (!adminId) {
                console.error("Erreur : ID de admin non défini");
                alert("ID de admin manque.");
                return;
            }

            // Fetch slider data with AJAX
            $.ajax({
                url: "get_admin.php",
                method: "GET",
                data: { id_admin: adminId },
                dataType: "json",
                success: function (data) {
                    console.log("Réponse AJAX reçue :", data);

                    if (data.error) {
                        console.log("Erreur reçue du serveur :", data.error);
                        alert(data.error);
                    } else {
                        console.log("Données de admin reçues : ", data);

                        // Populate popup fields with the received data
                        $('#popupAdmin input[name="name"]').val(data.name);
                        $('#popupAdmin input[name="email"]').val(data.email);
                        $('#popupAdmin input[name="password"]').val();
                        $('#popupAdmin input[name="role"]').val(data.role);
                        $('#popupAdmin input[name="id_admin"]').val(data.id_admin);
                        $("#popupAdmin").show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur lors du chargement des données : ", error);
                    alert("Une erreur s'est produite lors du chargement des données.");
                }
            });
        });
        document.getElementById('closePopupAdmin').addEventListener('click', function () {
            document.getElementById('popupAdmin').style.display = 'none';
        });
    });

    //empecher l'envoie du formulaire si données identique
    document.querySelector("form[action='action_admin.php']").addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = e.target;
        const email = form.querySelector("input[name='email']").value;
        const password = form.querySelector("input[name='password']").value;
        const confirmPassword = form.querySelector("input[name='confirm_password']").value;

        // Vérifier si les mots de passe correspondent
        if (password !== confirmPassword) {
            alert("Les mots de passe ne correspondent pas.");
            return;
        }

        // Vérifier si l'email existe déjà
        const response = await fetch('check_mail.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email }),
        });

        const result = await response.json();

        if (result.exists) {
            alert("L'email existe déjà.");
            return;
        }

        // Si tout est bon, soumettre le formulaire
        form.submit();
    });

    //empecher l'envoie du formulaire si données identique
    document.querySelector("form[action='update_admin.php']").addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = e.target;
        const email = form.querySelector("input[name='email']").value;
        const password = form.querySelector("input[name='password']").value;
        const confirmPassword = form.querySelector("input[name='confirm_password']").value;

        // Vérifier si les mots de passe correspondent
        if (password !== confirmPassword) {
            alert("Les mots de passe ne correspondent pas.");
            return;
        }

        // Vérifier si l'email existe déjà
        const response = await fetch('check_mail.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email }),
        });

        const result = await response.json();

        if (result.exists) {
            alert("L'email existe déjà.");
            return;
        }

        // Si tout est bon, soumettre le formulaire
        form.submit();
    });



    console.log("ID galerie okay change");

    // Fonction pour récupérer les comptes de services et de sliders
    function fetchCounts() {
        console.log("Initialisation fetch");

        fetch('service_count.php') // Appel au script PHP
            .then(response => response.json()) // Conversion de la réponse en JSON
            .then(data => {
                console.log("Données reçues du serveur :", data);

                if (!data) {
                    console.error("Aucune donnée reçue du serveur.");
                    return;
                }

                // Vérifiez l'existence de l'élément sliderCount avant de l'utiliser
                const sliderCountElem = document.getElementById('sliderCount');
                if (sliderCountElem) {
                    sliderCountElem.textContent = data.total_slider;
                    console.log("Mise à jour de sliderCount effectuée");
                } else {
                    console.error("L'élément 'sliderCount' n'existe pas dans le DOM");
                }

                // Vérifiez l'existence de l'élément serviceCount avant de l'utiliser
                const serviceCountElem = document.getElementById('serviceCount');
                if (serviceCountElem) {
                    serviceCountElem.textContent = data.total_services;
                    console.log("Mise à jour de serviceCount effectuée");
                } else {
                    console.error("L'élément 'serviceCount' n'existe pas dans le DOM");
                }

                // Vérifiez l'existence de l'élément adminCount avant de l'utiliser
                const adminCountElem = document.getElementById('adminCount');
                if (adminCountElem) {
                    adminCountElem.textContent = data.total_admin;
                    console.log("Mise à jour de serviceCount effectuée");
                } else {
                    console.error("L'élément 'adminCount' n'existe pas dans le DOM");
                }

                // Vérifiez l'existence de l'élément imagesCount avant de l'utiliser
                const imagesCountElem = document.getElementById('imagesCount');
                if (imagesCountElem) {
                    imagesCountElem.textContent = data.total_images;
                    console.log("Mise à jour de imagesCount effectuée");
                } else {
                    console.error("L'élément 'imagesCount' n'existe pas dans le DOM");
                }
            })
            .catch(error => {
                console.error("Erreur lors de la récupération des données :", error);
            });
    }

    console.log('service done')


    $(".modifier_galerie").each(function () {
        console.log("Initialisation de .modifier_galerie");

        $(this).on("click", function () {
            console.log("Clique détecté sur .modifier_galerie");

            var galerieId = $(this).data("id_galerie"); // Vérifie si 'id_galerie' est défini
            console.log("ID galerie récupéré");

            if (!galerieId) {
                console.error("Erreur : ID de galerie non défini");
                alert("ID de galerie manquant.");
                return;
            }

            // Fetch slider data with AJAX
            $.ajax({
                url: "get_galerie.php",
                method: "GET",
                data: { id_galerie: galerieId }, // Modifie en 'id_galerie' pour correspondre à l'attribut HTML et PHP
                dataType: "json",
                success: function (data) {
                    console.log("Réponse AJAX reçue :", data);

                    if (data.error) {
                        console.log("Erreur reçue du serveur :", data.error);
                        alert(data.error);
                    } else {
                        console.log("Données de galerie reçues : ", data);

                        // Populate popup fields with the received data
                        $('#popupGalerie input[name="titre"]').val(data.titre);
                        $('#popupGalerie input[name="position"]').val(data.position);
                        $('#popupGalerie input[name="id_galerie"]').val(data.id_galerie);
                        $("#popupGalerie").show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur lors du chargement des données : ", error);
                    alert("Une erreur s'est produite lors du chargement des données.");
                }
            });
        });
    });

    console.log("fetch okay");
    // Appel de la fonction au chargement de la page
    $(document).ready(function () {
        fetchCounts();
    });

    console.log("gestion popup");

    // Gestion de la fermeture de la popup

    document.getElementById('closeGalerieModifierBtn').addEventListener('click', function () {
        document.getElementById('popupGalerie').style.display = 'none';
    });
    console.log("TEST 5");



});
