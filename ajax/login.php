<?php
require('../database.php');
if ( ! session_id() ) @ session_start();
$query = $pdo->prepare('SELECT username FROM users WHERE username=? AND password=?');
$query->execute(array($_GET['username'], md5($_GET['password'])));
$username = $query->fetch(PDO::FETCH_ASSOC);
if (isset($username)) {
    $_SESSION["CONNECTED_USER"] = true;
    echo $username['username'];
} else {
    echo "nok";
}