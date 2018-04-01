jQuery("#login").submit(function() {
    var username = jQuery("#login #username").val();
    var password = jQuery("#login #password").val();
    var referer = jQuery("#login #referer").val();
    if (username == "" && password == "") {
        jQuery("#login #error").show();
        location.href = '#error';
        return false;
    } else {
        jQuery.ajax({
            method: "GET",
            url: "ajax/login.php",
            data: {username: username, password: password}
        }).done(function(response) {
            if (response != "nok") {
                window.location.href = referer;
                return true;
            } else {
                jQuery("#login #access").show();
                return false;
            }
        });
        return false;
    }

});