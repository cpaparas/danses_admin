//Formulaire profile
jQuery( document ).ready(function() {
	if (jQuery(".checkbox #cb_professeur").checked) {
		jQuery("#gropupes_profs").show();
	} else {
		jQuery("#gropupes_profs").hide();
	}
});

jQuery(".checkbox #cb_professeur").change(function(){
	if (this.checked) {
		jQuery("#gropupes_profs").show();
		jQuery("#professeur").val(true);
	} else {
		jQuery("#gropupes_profs").hide();
		jQuery("#id_groupe_prof").val('')
		jQuery("#professeur").val(false);
	}
	
});

jQuery("#form_profile").submit(function() {
	
});