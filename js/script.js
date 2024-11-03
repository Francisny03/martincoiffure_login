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

});
