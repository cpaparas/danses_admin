<?php
require('database.php');
if (isset($_GET["id_event"])) {
    $queryDeleteEvent = $pdo->prepare('DELETE FROM `evenement` WHERE id=?');
    $queryDeleteEvent->execute(array($_GET["id_event"]));

    $queryDeletePresences = $pdo->prepare('DELETE FROM `event_participation` WHERE id_event=?');
    $queryDeletePresences->execute(array($_GET["id_event"]));
}
header('Location: liste_events.php');
