//Formulaire profile
jQuery( document ).ready(function() {
	if (jQuery("#professeur").val() == "1") {
		jQuery("#gropupes_profs").show();
		jQuery(".checkbox #cb_professeur").checked = 'checked';
	} else {
        jQuery("#gropupes_profs").hide();
	}
});

jQuery(".checkbox #cb_professeur").change(function(){
	if (this.checked) {
		jQuery("#gropupes_profs").show();
		jQuery("#professeur").val(1);
	} else {
		jQuery("#gropupes_profs").hide();
		jQuery("#id_groupe_prof").val('')
		jQuery("#professeur").val(0);
	}
	
});

jQuery("#form_profile").submit(function() {
	var nom = jQuery("#form_profile #nom").val();
    var prenom = jQuery("#form_profile #prenomnom").val();
    var email = jQuery("#form_profile #email").val();
	if (nom == "" || prenom == "" || email == "") {
        jQuery("#form_profile #error").show();
        location.href = '#error';
        return false;
	} else {
        return true;
	}

});