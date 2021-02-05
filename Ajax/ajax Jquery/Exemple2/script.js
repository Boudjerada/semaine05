$(document).ready(function() {

    $("#select1").load("listeoptions1.php");

    $("#select1").change(function() {
        let v = $('#select1').val();

        $("#select2").load(`listeoptions2.php?id_region=${v}`);
    });
});