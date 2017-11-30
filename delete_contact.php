<?php
require('database.php');
if (isset($_GET["id_contact"])) {
    $queryDeleteContact = $pdo->prepare('DELETE FROM `contact` WHERE id=?');
    $queryDeleteContact->execute(array($_GET["id_contact"]));
}
header('Location: cours_liste.php');
