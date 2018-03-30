<?php
require('database.php');


$query = $pdo->prepare('SELECT * FROM `evenement`');

$query->execute();
$events = $query->fetchAll(PDO::FETCH_ASSOC);




$title = "Gestionnaire de danse - Liste des événements";
include('header_technique.php');
?>
<body>
<?php
$h1 = "Liste des événements";
include('header.php');
?>
<main>

    <?php
    include('nav.php');
    ?>
    <div class="col-10 item ">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date</th>
                <th>&Eacute;dition</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($events as $ev )
            {
                echo "<tr>";
                echo "<td>".$ev['id']."</td>";
                echo "<td>".$ev['titre']."</td>";
                echo "<td>".$ev['date_debut']."</td>";
                echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_event.php?id_event=".$ev['id']."'\" value='Modifier' /></td>";
                echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_event.php?id_event=".$ev['id']."'\" value='Supprimer' /></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <input class="btn right" type="button" onclick="window.location.href='form_event.php'" value="Créer un événement" />
    </div>
</main>
</body>
</html>