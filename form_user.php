<?php
require('database.php');

if (isset($_GET['user'])) {
    $query = $pdo->prepare('SELECT * FROM users WHERE username =?');

    $query->execute([$_GET['user']]);

    $user = $query->fetch(PDO::FETCH_ASSOC);

}
$title = "Gestionnaire de danse - Gestion des utilisateurs";
include('header_technique.php');
?>

<body>
<?php
$h1 = "Gestion des utilisateurs";
include('header.php');
?>
<main>
    <?php
    include('nav.php');
    ?>
    <div class="col-10 item ">
        <form id="form_user" method="POST" action="save_user.php">
            <p><i>Les champs suivis d'un * sont obligatoires</i></p>
            <div id="error">Veuillez vérifier que tous les champs obligatoires ont bien été saisis</div>
            <fieldset>
                <input type="hidden" name="old_username" id="old_username" value="<?= isset($user['username']) ? $user['username'] : '' ?>">
                <input type="hidden" name="old_password" id="old_password" value="<?= isset($user['password']) ? $user['password'] : '' ?>">
                <input type="hidden" name="id" id="id" value="<?=isset($_GET["id_profile"]) ? $_GET["id_profile"] : "" ?>">
                <div class="form-group">
                    <label for="username">Utilisateur *:</label>
                    <input class='form-control' type="text" name="username" id="username" size="50" value="<?= isset($user['username']) ? $user['username'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe *:</label>
                    <input class='form-control' type="password" name="password" id="password" size="50" value="<?= isset($user['password']) ? $user['password'] : '' ?>">
                </div>
                <input class="btn" type="submit" name="submit_user" value="Enregistrer">
            </fieldset>
        </form>
    </div>
</main>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>