<?php
require('database.php');

if (isset($_GET['id_cours'])) {
    $query = $pdo->prepare('SELECT * FROM cours WHERE id =?');

    $query->execute([$_GET['id_cours']]);

    $cours = $query->fetch(PDO::FETCH_ASSOC);

    $queryCoursProfiles = $pdo->prepare('SELECT id_profile FROM `cours_presences` WHERE id_cours=?');

    $queryCoursProfiles->execute([$_GET['id_cours']]);

    $cours_prof = $queryCoursProfiles->fetchAll(PDO::FETCH_ASSOC);
}

$queryGrpe = $pdo->prepare('SELECT * FROM groupes');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

$title = "Gestionnaire de danse - Formulaire du cours";
include('header_technique.php');
?>

<body>
<?php
$h1 = "Gestion du cours";
include('header.php');
?>
<main>
    <?php
    include('nav.php');
    ?>
    <div class="col-10 item ">
        <form id="form_profile" method="POST" action="save_cours.php">
            <p><i>Les champs suivis d'un * sont obligatoires</i></p>
            <div id="error">Veuillez vérifier que tous les champs obligatoires ont bien été saisis</div>
            <fieldset>
                <input type="hidden" name="id" id="id" value="<?=isset($_GET["id_cours"]) ? $_GET["id_cours"] : "" ?>">
                <div class="form-group">
                    <label for="date">Date du cours * :</label>
                    <input class='form-control' type="date" name="date" id="date" size="50" value="<?= isset($cours['date']) ? $cours['date'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="danses">Programme :</label>
                    <textarea class="form-control" rows="5" id="danses" name="danses"><?= isset($cours['danses'])  ? $cours['danses'] : '' ?></textarea>
                </div>
                <div class="form-group" id="gropupes">
                    <label for="id_groupe">Groupe :</label>
                    <select id="id_groupe" name="id_groupe" class='form-control'>
                        <option value="">---------------</option>
                        <?php
                        if ($groupes) {
                            foreach ($groupes as $grpe) {
                                echo '<option value="'.$grpe['id'].'" ';
                                if (isset($cours["id_groupe"]) && $grpe["id"] == $cours["id_groupe"]) {
                                    echo "selected='selected'";
                                }
                                echo '>'.$grpe['nom'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="checkbox" id="cours_presences">
                </div>
                <div class="form-group">
                    <label for="commentaires">Commentaires :</label>
                    <textarea class="form-control" rows="5" id="commentaires" name="commentaires"><?= isset($cours['commentaires'])  ? $cours['commentaires'] : '' ?></textarea>
                </div>
                <input type="submit" name="submit_profile" value="Enregistrer">
            </fieldset>
        </form>
    </div>
</main>
<script type="text/javascript" src="js/cours.js"></script>
</body>
</html>