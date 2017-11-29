<?php
require('database.php');
if ($_POST["id"] != "")
{
    $query = $pdo->prepare('UPDATE `evenement` SET `titre`=? , `date_debut`=? , `date_fin`=? , `description`=? , `lieu`=? , `adresse`=? , `code_postal`=? , `ville`=? , `pays`=? , `nombre_danseurs`=? , `programme`=? , `type`=? , `costumes`=? , `id_prof`=? WHERE id =?'
    );
    $query->execute(array(
        $_POST['titre'],
        $_POST['date_debut'],
        $_POST['date_fin'],
        $_POST['description'],
        $_POST['lieu'],
        $_POST['adresse'],
        $_POST['code_postal'],
        $_POST['ville'],
        $_POST['pays'],
        $_POST['nombre_danseurs'],
        $_POST['programme'],
        $_POST['type'],
        $_POST['costumes'],
        $_POST['id_prof'],
        $_POST['id']
    ));
    if ($_POST["participants"]) {
        $queryDelete = $pdo->prepare('DELETE FROM `event_participation` WHERE id_cours=?');
        $queryDelete->execute(array($_POST["id"]));



        foreach ($_POST["participants"] AS $key => $val) {
            $queryPres = $pdo->prepare('INSERT INTO `event_participation` (`id_event`, `id_profile`) VALUES (?,?)');
            $queryPres->execute(array((int)$_POST["id"],(int)$val));
        }
    }
}
else {

    $query = $pdo->prepare('INSERT INTO `evenement` (`titre`, `date_debut`, `date_fin`, `description`, `lieu`, `adresse`, `code_postal`, `ville`, `pays`, `nombre_danseurs`, `programme`, `type`, `costumes`, `id_prof`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $query->execute(array(
        $_POST['titre'],
        $_POST['date_debut'],
        $_POST['date_fin'],
        $_POST['description'],
        $_POST['lieu'],
        $_POST['adresse'],
        $_POST['code_postal'],
        $_POST['ville'],
        $_POST['pays'],
        $_POST['nombre_danseurs'],
        $_POST['programme'],
        $_POST['type'],
        $_POST['costumes'],
        $_POST['id_prof']
    ));

    if ($_POST["participants"]) {
        $queryId = $pdo->prepare('SELECT max(id) AS id FROM `evenement` ');
        $queryId->execute();

        $id =$queryId->fetch(PDO::FETCH_ASSOC);

        foreach ($_POST["participants"] AS $key => $val) {
            $queryPres = $pdo->prepare('INSERT INTO `event_participation` (`id_event`, `id_profile`) VALUES (?,?)');
            $queryPres->execute(array((int)$id['id'],(int)$val));
        }
    }
}
header('Location: liste_events.php');