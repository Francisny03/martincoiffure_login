console.log('Test 1');

new DataTable('#example');

console.log('Test 2');

$(document).ready(function () {
    // Loop through each span with class starting with 'p'
    $('span[class^="p"]').each(function () {
        var spanClass = $(this).attr('class');
        // Find the corresponding menu item and replace the class with 'active'
        $('.liens .' + spanClass).addClass('active').removeClass(spanClass);
    });
});

console.log('Popup 2');
document.addEventListener("DOMContentLoaded", function () {
    // Ouvrir la popup
    document.getElementById("myBtn").addEventListener("click", function () {
        const popup = document.getElementById("popup");
        popup.style.display = "block";
    });

    // Fermer la popup
    document.getElementById("closePopupBtn").addEventListener("click", function () {
        document.getElementById("popup").style.display = "none";
    });
});

console.log('Popup 4');

$(document).ready(function () {
    $('#example').DataTable({
        "order": [[0, "desc"]], // Changez le 0 par l'index de votre colonne `id`
        "destroy": true // Permet de détruire l'instance existante
    });
});


console.log('Table 2');
