jQuery("#form_user").submit(function() {
    var username = jQuery("#form_user #username").val();
    var password = jQuery("#form_user #password").val();

    if (username == "" || password == "") {
        jQuery("#form_user #error").show();
        location.href = '#error';
        return false;
    } else {
        return true;
    }

});