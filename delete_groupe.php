<?php
require('database.php');
if (isset($_GET["id_groupe"])) {
    $queryDeleteGroupe = $pdo->prepare('DELETE FROM `groupes` WHERE id=?');
    $queryDeleteGroupe->execute(array($_GET["id_groupe"]));

    $queryDeleteProfileGrp = $pdo->prepare('DELETE FROM `profile_groupes` WHERE id_groupe=?');
    $queryDeleteProfileGrp->execute(array($_GET["id_groupe"]));
}
header('Location: groupes_liste.php');
