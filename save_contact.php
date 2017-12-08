<?php
require('database.php');
if ($_POST["id"] != "")
{
    $query = $pdo->prepare('UPDATE `contact` SET `nom`=?, `prenom`=?, `email`=?,`telephone`=?,`organisation`=?,`fonction`=?, `commentaires`=? WHERE id =?'
    );
    $query->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['organisation'],
        $_POST['fonction'],
        $_POST['commentaires'],
        $_POST['id']
    ));
}
else {

    $query = $pdo->prepare('INSERT INTO `contact` (`nom`, `prenom`, `email`,`telephone`,`organisation`,`fonction`, `commentaires`) VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $query->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['organisation'],
        $_POST['fonction'],
        $_POST['commentaires']
    ));
}
header('Location: contact_liste.php');