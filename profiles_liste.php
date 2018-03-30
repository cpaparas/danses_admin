<?php
require('database.php');
$queryGrpe = $pdo->prepare('SELECT * FROM groupes');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id_groupe']) && $_GET['id_groupe'] != "") {
    $query = $pdo->prepare('SELECT `profile`.* FROM `profile`, `profile_groupes` WHERE `profile_groupes`.id_profile = `profile`.id AND `profile_groupes`.id_groupe=?');

    $query->execute(array($_GET['id_groupe']));
    $profiles = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = $pdo->prepare('SELECT * FROM `profile`');

    $query->execute();
    $profiles = $query->fetchAll(PDO::FETCH_ASSOC);
}

$title = "Gestionnaire de danse - Liste des profiles";
include('header_technique.php');
?>
<body>
	<?php
		$h1 = "Liste des profiles";
		include('header.php');
	?>
	<main>

	<?php 
		include('nav.php');
	?>
	<div class="col-10 item ">
        <div class="profile_search">
            <form id="profile_search" action="profiles_liste.php" method="GET">
                <label for="id_groupe">Danseurs du groupe :</label>
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
                <input type="submit" name="search_profile" value="Rechercher">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Préom</th>
                    <th>Email</th>
                    <th>&Eacute;dition</th>
                    <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($profiles as $profile )
                    {
                        echo "<tr>";
                        echo "<td>".$profile['id']."</td>";
                        echo "<td>".$profile['nom']."</td>";
                        echo "<td>".$profile['prenom']."</td>";
                        echo "<td>".$profile['email']."</td>";
                        echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_profile.php?id_profile=".$profile['id']."'\" value='Modifier' /></td>";
                        echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_profile.php?id_profile=".$profile['id']."'\" value='Supprimer' /></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <input class="btn right" type="button" onclick="window.location.href='form_profile.php'" value="Créer un profile" />
</div>
</main>
</body>
</html>