jQuery("#form_contact").submit(function() {
    var nom = jQuery("#form_contact #nom").val();
    var prenom = jQuery("#form_contact #prenom").val();
    var email = jQuery("#form_contact #email").val();
    if (nom == "" || prenom == "" || email == "") {
        jQuery("#form_contact #error").show();
        location.href = '#error';
        return false;
    } else {
        return true;
    }

});