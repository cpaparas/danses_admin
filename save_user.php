<?php
require('database.php');
if ($_POST["id"] != "")
{
    if ($_POST["old_password"] != $_POST['password']) {
        $_POST['password'] = md5($_POST['password']);
    }


    $query = $pdo->prepare('UPDATE `users` SET `username`=?, `password`=?,  WHERE username =?'
    );
    $query->execute(array(
        $_POST['username'],
        $_POST['password'],
        $_POST['old_username']
    ));
}
else {

    $query = $pdo->prepare('INSERT INTO `users` (`username`, `password`) VALUES (?, ?)'
    );
    $query->execute(array(
        $_POST['username'],
        md5($_POST['password'])
    ));
}
header('Location: users_liste.php');