<?php
require('database.php');
if (isset($_GET["id_profile"])) {
    $queryDeleteProfile = $pdo->prepare('DELETE FROM `profile` WHERE id=?');
    $queryDeleteProfile->execute(array($_GET["id_profile"]));

    $queryDeleteProfileGrp = $pdo->prepare('DELETE FROM `profile_groupes` WHERE id_profile=?');
    $queryDeleteProfileGrp->execute(array($_GET["id_profile"]));
}
header('Location: profiles_liste.php');
