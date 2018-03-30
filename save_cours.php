<?php
require('database.php');
if ($_POST["id"] != "")
{
    $query = $pdo->prepare('UPDATE `cours` SET `date`=?, `danses`=?, `id_groupe`=?, `commentaires`=? WHERE id =?'
    );
    $query->execute(array(
        $_POST['date'],
        $_POST['danses'],
        $_POST['id_groupe'],
        $_POST['commentaires'],
        $_POST['id']
    ));
    if ($_POST["presences"]) {
        $queryDelete = $pdo->prepare('DELETE FROM `cours_presences` WHERE id_cours=?');
        $queryDelete->execute(array($_POST["id"]));



        foreach ($_POST["presences"] AS $key => $val) {
            $queryPres = $pdo->prepare('INSERT INTO `cours_presences` (`id_cours`, `id_profile`) VALUES (?,?)');
            $queryPres->execute(array((int)$_POST["id"],(int)$val));
        }
    }
}
else {

    $query = $pdo->prepare('INSERT INTO `cours` (`date`, `danses`, `id_groupe`, `commentaires`) VALUES (?, ?, ?, ?)'
    );
    $query->execute(array(
        $_POST['date'],
        $_POST['danses'],
        $_POST['id_groupe'],
        $_POST['commentaires']
    ));

    if ($_POST["presences"]) {
        $queryId = $pdo->prepare('SELECT id FROM `cours` WHERE date=? AND id_groupe=?');
        $queryId->execute(array($_POST['date'],
            $_POST['id_groupe']));

        $id =$queryId->fetch(PDO::FETCH_ASSOC);

        foreach ($_POST["presences"] AS $key => $val) {
            $queryPres = $pdo->prepare('INSERT INTO `cours_presences` (`id_cours`, `id_profile`) VALUES (?,?)');
            $queryPres->execute(array((int)$id['id'],(int)$val));
        }
    }
}
header('Location: cours_liste.php');