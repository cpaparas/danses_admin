jQuery( document ).ready(function() {
    var grpe_id = jQuery("#id_groupe").val();
    var cours_id = jQuery("#id").val();
    if (typeof grpe_id != "undefiend") {
        jQuery.ajax({
            method: "POST",
            url: "ajax/get_profiles_by_groupe_id.php",
            data: {id_groupe: grpe_id, id_cours: cours_id},
            dataType: "html"
        }).done(function(html) {
            jQuery("#cours_presences").html(html);
        });
    }
});


jQuery("#id_groupe").change(function(){
    var grpe_id = jQuery("#id_groupe").val();
    var cours_id = jQuery("#id").val();
    if (typeof grpe_id != "undefiend") {
        jQuery.ajax({
            method: "POST",
            url: "ajax/get_profiles_by_groupe_id.php",
            data: {id_groupe: grpe_id, id_cours: cours_id},
            dataType: "html"
        }).done(function(html) {
            jQuery("#cours_presences").html(html);
        });
    }
});

jQuery("#form_cours").submit(function() {
    var date = jQuery("#form_cours #date").val();

    if (date == "") {
        jQuery("#form_cours #error").show();
        location.href = '#error';
        return false;
    } else {
        return true;
    }

});