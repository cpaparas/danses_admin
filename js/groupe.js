jQuery("#form_groupe").submit(function() {
    var nom = jQuery("#form_groupe #nom").val();
    if (nom == "") {
        jQuery("#form_groupe #error").show();
        location.href = '#error';
        return false;
    } else {
        return true;
    }

});