<?php
require('database.php');

if (isset($_GET['id_event'])) {
    $query = $pdo->prepare('SELECT * FROM evenement WHERE id =?');

    $query->execute([$_GET['id_event']]);

    $event = $query->fetch(PDO::FETCH_ASSOC);

    $queryParticipants = $pdo->prepare('SELECT * FROM event_participation WHERE id_event =?');
    $queryParticipants->execute([$_GET['id_event']]);

    $aParticipants = $queryParticipants->fetchAll(PDO::FETCH_ASSOC);

}

$queryProfs = $pdo->prepare('SELECT id, CONCAT(nom, \' \', prenom) AS nom FROM `profile` WHERE professeur = 1');
$queryProfs->execute();
$aProfs = $queryProfs->fetchAll(PDO::FETCH_ASSOC);

$queryContats = $pdo->prepare('SELECT id, CONCAT(nom, \' \', prenom) AS nom FROM `contact`');
$queryContats->execute();
$aContacts = $queryContats->fetchAll(PDO::FETCH_ASSOC);


$queryDanseurs = $pdo->prepare('SELECT id, CONCAT(nom, \' \', prenom) AS nom FROM `profile`');
$queryDanseurs->execute();
$aDanseurs = $queryDanseurs->fetchAll(PDO::FETCH_ASSOC);

$aType = array();
$aType[1] = "Représentation";
$aType[2] = "Défilé";
$aType[3] = "Défilé et représentation";
$title = "Gestionnaire de danse - Formulaire d'événement";
include('header_technique.php');
?>

<body>
<?php
$h1 = "Gestion des événements";
include('header.php');
?>
<main>
    <?php
    include('nav.php');
    ?>
    <div class="col-10 item ">
        <form id="form_event" method="POST" action="save_event.php">
            <p><i>Les champs suivis d'un * sont obligatoires</i></p>
            <div id="error">Veuillez vérifier que tous les champs obligatoires ont bien été saisis</div>
            <fieldset>
                <input type="hidden" name="id" id="id" value="<?=isset($_GET["id_event"]) ? $_GET["id_event"] : "" ?>">
                <div class="form-group">
                    <label for="titre">Titre * :</label>
                    <input class='form-control' type="text" name="titre" id="titre" size="50" value="<?= isset($event['titre']) ? $event['titre'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="type">Type d'événement * :</label>
                    <select id="type" name="type" class='form-control'>
                        <option value="">---------------</option>
                        <?php
                        if ($aType) {
                            foreach ($aType as $key => $val) {
                                echo '<option value="'.$key.'" ';
                                if (isset($event["type"]) && $key == $event["type"]) {
                                    echo "selected='selected'";
                                }
                                echo '>'.$val.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_prof">Responsable :</label>
                    <select id="id_prof" name="id_prof" class='form-control'>
                        <option value="">---------------</option>
                        <?php
                        if ($aProfs) {
                            foreach ($aProfs as $prof) {
                                echo '<option value="'.$prof['id'].'" ';
                                if (isset($event["id_prof"]) && $prof['id'] == $event["id_prof"]) {
                                    echo "selected='selected'";
                                }
                                echo '>'.$prof['nom'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_contact">Contact :</label>
                    <select id="id_contact" name="id_contact" class='form-control'>
                        <option value="">---------------</option>
                        <?php
                        if ($aContacts) {
                            foreach ($aContacts as $contact) {
                                echo '<option value="'.$contact['id'].'" ';
                                if (isset($event["id_contact"]) && $contact['id'] == $event["id_contact"]) {
                                    echo "selected='selected'";
                                }
                                echo '>'.$contact['nom'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_debut">Date de début * :</label>
                    <input class='form-control' type="date" name="date_debut" id="date_debut" size="50" value="<?= isset($event['date_debut']) ? $event['date_debut'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="date_fin">Date de fin :</label>
                    <input class='form-control' type="date" name="date_fin" id="date_fin" size="50" value="<?= isset($event['date_fin']) ? $event['date_fin'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea class="form-control" rows="5" id="description" name="description"><?= isset($event['description'])  ? $event['description'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="lieu">Lieu :</label>
                    <input class='form-control' type="text" name="lieu" id="lieu" size="50" value="<?= isset($event['lieu']) ? $event['lieu'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse :</label>
                    <input class='form-control' type="text" name="adresse" id="adresse" size="50" value="<?= isset($event['adresse']) ? $event['adresse'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="code_postal">Code postal :</label>
                    <input class='form-control' type="text" name="code_postal" id="code_postal" size="5" value="<?= isset($event['code_postal']) ? $event['code_postal'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="ville">Ville :</label>
                    <input class='form-control' type="text" name="ville" id="ville" size="50" value="<?= isset($event['ville']) ? $event['ville'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="pays">Pays :</label>
                    <input class='form-control' type="text" name="pays" id="pays" size="50" value="<?= isset($event['pays']) ? $event['pays'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="nombre_danseurs">Nombre de danseurs :</label>
                    <input class='form-control' type="number" name="nombre_danseurs" id="nombre_danseurs" size="50" value="<?= isset($event['nombre_danseurs']) ? $event['nombre_danseurs'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="programme">Programme :</label>
                    <textarea class="form-control" rows="5" id="programme" name="programme"><?= isset($event['programme'])  ? $event['programme'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="costumes">Costumes :</label>
                    <textarea class="form-control" rows="5" id="costumes" name="costumes"><?= isset($event['costumes'])  ? $event['costumes'] : '' ?></textarea>
                </div>
                <hr />
                <div class="form-group">
                    <label for="participants[]">Danseurs :</label>
                    <?php
                        $i = 0;
                        echo "<table id='participants_table'>";
                        if ($aDanseurs) {
                            foreach ($aDanseurs as $danseur) {
                                if ($i == 0) {
                                    echo "<tr>";
                                }
                                //echo "<td>".$danseur['nom']."</td>";
                                echo '<td><input type="checkbox" value="'.$danseur['id'].'" ';
                                if (isset($aParticipants)) {
                                    foreach ($aParticipants as $part) {
                                        if ($danseur['id'] == $part['id_profile']) {
                                            echo "checked='checked'";
                                        }
                                    }
                                }
                                echo 'id="participants[]" name="participants[]"> '.$danseur['nom'].'</td>';
                                $i++;

                                if ($i == 3) {
                                    echo "</tr>";
                                    $i = 0;
                                }
                            }
                        }
                        echo "</table>";
                    ?>
                </div>
                <input type="submit" name="submit_profile" value="Enregistrer">
            </fieldset>
        </form>
    </div>
</main>
<script type="text/javascript" src="js/event.js"></script>
</body>
</html>