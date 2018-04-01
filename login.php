<?php
require('database.php');
if ( ! session_id() ) @ session_start();

if (isset($_SESSION["CONNECTED_USER"])) {
    header('Location: /');
}

$title = "Gestionnaire de danse - Formulaire de connexion";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=GFS+Didot|Hammersmith+One" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tables.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<?php
$h1 = "Formulaire de connexion";
include('header.php');

?>
<main>

    <nav id="sommaire" class="col-2">

    </nav>
    <div class="col-10 item ">
        <form id="login" method="POST">
            <p><i>Les champs suivis d'un * sont obligatoires</i></p>
            <div id="error">Veuillez vérifier que tous les champs obligatoires ont bien été saisis</div>
            <fieldset>
                <input type="hidden" name="referer" id="referer" value="<?=isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : $_SERVER["HTTP_HOST"].$_SERVER["CONTEXT_PREFIX"] ?>">
                <div class="form-group">
                    <label for="username">Utilisateur * :</label>
                    <input class='form-control' type="text" name="username" id="username" size="50" value="">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe * :</label>
                    <input class='form-control' type="password" name="password" id="password" size="50" value="">
                </div>
                <input class="btn" type="submit" name="login" value="Connexion">

            </fieldset>
        </form>
    </div>
</main>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>