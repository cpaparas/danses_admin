<?php
if ( ! session_id() ) @ session_start();

if (isset($_SESSION["CONNECTED_USER"])) {
    unset($_SESSION["CONNECTED_USER"]);
    header('Location: login.php');
}