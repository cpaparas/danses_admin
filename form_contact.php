<?php
require('database.php');

if (isset($_GET['id_contact'])) {
    $query = $pdo->prepare('SELECT * FROM contact WHERE id =?');

    $query->execute([$_GET['id_contact']]);

    $contact = $query->fetch(PDO::FETCH_ASSOC);

}
$title = "Gestionnaire de danse - Gestion des contacts";
include('header_technique.php');
?>

<body>
<?php
$h1 = "Gestion des contacts";
include('header.php');
?>
<main>
    <?php
    include('nav.php');
    ?>
    <div class="col-10 item ">
        <form id="form_contact" method="POST" action="save_contact.php">
            <p><i>Les champs suivis d'un * sont obligatoires</i></p>
            <div id="error">Veuillez vérifier que tous les champs obligatoires ont bien été saisis</div>
            <fieldset>
                <input type="hidden" name="id" id="id" value="<?=isset($_GET["id_contact"]) ? $_GET["id_contact"] : "" ?>">
                <div class="form-group">
                    <label for="nom">Nom *:</label>
                    <input class='form-control' type="text" name="nom" id="nom" size="50" value="<?= isset($contact['nom']) ? $contact['nom'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom *:</label>
                    <input class='form-control' type="text" name="prenom" id="prenom" size="50" value="<?= isset($contact['prenom']) ? $contact['prenom'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email *:</label>
                    <input class='form-control' type="email" name="email" id="email" size="50" value="<?= isset($contact['email']) ? $contact['email'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input class='form-control' type="text" placeholder="+33 6 24 55 88 88" name="telephone" id="telephone" value="<?= isset($contact['telephone']) ? $contact['telephone'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="organisation">Organisation :</label>
                    <input class='form-control' type="text" name="organisation" id="organisation" size="50" value="<?= isset($contact['organisation']) ? $contact['organisation'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="fonction">Fonction :</label>
                    <input class='form-control' type="text" name="fonction" id="fonction" size="50" value="<?= isset($contact['fonction']) ? $contact['fonction'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="commentaires">Commentaires :</label>
                    <textarea class="form-control" rows="5" id="commentaires" name="commentaires"><?= isset($event['commentaires'])  ? $event['commentaires'] : '' ?></textarea>
                </div>
                <input type="submit" name="submit_contact" value="Enregistrer">
            </fieldset>
        </form>
    </div>
</main>
<script type="text/javascript" src="js/contact.js"></script>
</body>
</html>