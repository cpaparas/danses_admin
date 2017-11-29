<?php
$title = "Gestionnaire de danse - Accueil";
include('header_technique.php');
?>
<body>
<?php
$h1 = "Bienvenue sur le gestionnaire de danse";
include('header.php');
?>
<main>

    <?php
    include('nav.php');
    ?>

    <div class="col-10 item ">
        <div id='calendar'></div>
    </div>
    <input class="btn" type="button" onclick="window.location.href='form_cours.php'" value="Créer un cours" />
    <input class="btn" type="button" onclick="window.location.href='form_event.php'" value="Créer un événement" />
</main>
<footer>

</footer>
<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='js/moment.min.js'></script>
<script src='js/jquery.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script src='js/locale-all.js'></script>
<script>

    jQuery(document).ready(function() {
        var initialLocaleCode = 'fr';
        jQuery.ajax({
            method: "POST",
            url: "../ajax/get_events.php",
            dataType: "json"
        }).done(function(data) {
            jQuery('#calendar').fullCalendar({
                defaultDate: '2017-11-12',
                locale: initialLocaleCode,
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: data
            });
        });


    });

</script>
<style>

    body {
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    .fc-event, .fc-event:hover {
        color: #fff !important;
    }
</style>
</body>
</html>
