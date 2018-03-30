jQuery("#form_event").submit(function() {
    var titre = jQuery("#form_event #titre").val();
    var type = jQuery("#form_event #type").val();
    var date_debut = jQuery("#form_event #date_debut").val();
    if (titre == "" || type == "" || date_debut == "") {
        jQuery("#form_event #error").show();
        location.href = '#error';
        return false;
    } else {
        return true;
    }

});