<?php
require('database.php');

$queryGrpe = $pdo->prepare('SELECT * FROM groupes');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id_groupe']) && $_GET['id_groupe'] != "" && isset($_GET['date']) && $_GET['date'] != "") {
    $query = $pdo->prepare('SELECT c.id, DATE_FORMAT(c.date, "%d/%m/%Y") AS date, c.commentaires, g.nom FROM `cours` AS c, `groupes` AS g WHERE g.id = c.id_groupe AND id_groupe=? AND date=?');

    $query->execute(array($_GET['id_groupe'],$_GET['date']));
    $cours = $query->fetchAll(PDO::FETCH_ASSOC);
} elseif (isset($_GET['id_groupe']) && $_GET['id_groupe'] != "") {
    $query = $pdo->prepare('SELECT c.id, DATE_FORMAT(c.date, "%d/%m/%Y") AS date, c.commentaires, g.nom FROM `cours` AS c, `groupes` AS g WHERE g.id = c.id_groupe AND id_groupe=?');

    $query->execute(array($_GET['id_groupe']));
    $cours = $query->fetchAll(PDO::FETCH_ASSOC);
} elseif (isset($_GET['date']) && $_GET['date'] != "") {
    $query = $pdo->prepare('SELECT c.id, DATE_FORMAT(c.date, "%d/%m/%Y") AS date, c.commentaires, g.nom FROM `cours` AS c, `groupes` AS g WHERE g.id = c.id_groupe AND date=?');

    $query->execute(array($_GET['date']));
    $cours = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = $pdo->prepare('SELECT c.id, DATE_FORMAT(c.date, "%d/%m/%Y") AS date, c.commentaires, g.nom FROM `cours` AS c, `groupes` AS g WHERE g.id = c.id_groupe');

    $query->execute();
    $cours = $query->fetchAll(PDO::FETCH_ASSOC);
}



$title = "Gestionnaire de danse - Liste des cours";
include('header_technique.php');
?>
<body>
	<?php
		$h1 = "Liste des cours";
		include('header.php');
	?>
	<main>

	<?php 
		include('nav.php');
	?>
	<div class="col-10 item ">
        <div class="cours_search">
            <form id="cours_search" action="cours_liste.php" method="GET">
                <label for="id_groupe">Cours du groupe :</label>
                <select id="id_groupe" name="id_groupe" class=''>
                    <option value="">---------------</option>
                    <?php
                    if ($groupes) {
                        foreach ($groupes as $grpe) {
                            echo '<option value="'.$grpe['id'].'" ';
                            if (isset($_GET["id_groupe"]) && $_GET["id_groupe"] == $grpe["id"]) {
                                echo "selected='selected'";
                            }
                            echo '>'.$grpe['nom'].'</option>';
                        }
                    }
                    ?>
                </select>
                <label for="date">Date du cours :</label>
                <input class='' type="date" name="date" id="date" size="50" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
                <input type="submit" name="search_cours" value="Rechercher">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Groupe</th>
                    <th>&Eacute;dition</th>
                    <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($cours as $cr )
                    {
                        echo "<tr>";
                        echo "<td>".$cr['id']."</td>";
                        echo "<td>Cours du ".$cr['date']."</td>";
                        echo "<td>".$cr['nom']."</td>";
                        echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_cours.php?id_cours=".$cr['id']."'\" value='Modifier' /></td>";
                        echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_cours.php?id_cours=".$cr['id']."'\" value='Supprimer' /></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <input class="btn right" type="button" onclick="window.location.href='form_cours.php'" value="Créer un cours" />
</div>
</main>
</body>
</html>