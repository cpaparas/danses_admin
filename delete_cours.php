<?php
require('database.php');
if (isset($_GET["id_cours"])) {
    $queryDeleteCours = $pdo->prepare('DELETE FROM `cours` WHERE id=?');
    $queryDeleteCours->execute(array($_GET["id_cours"]));

    $queryDeletePresences = $pdo->prepare('DELETE FROM `cours_presences` WHERE id_cours=?');
    $queryDeletePresences->execute(array($_GET["id_cours"]));
}
header('Location: cours_liste.php');
