$(document).ready(function() {
    $("#dataTable").DataTable({
    responsive: true,
            language: {
                url: '../vendor/datatables/es-ar.json' //Ubicacion del archivo con el json del idioma.
            }
    })
});