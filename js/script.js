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
                        $("#popupSlider").show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Data loading error: ", error);
                    alert("Une erreur s'est produite lors du chargement des données.");
                }
            });
        });
    });

    // Close the edit popup
    $("#popupSlider .closePopupbtn").on("click", function () {
        $("#popupSlider").hide();
    });
});
