<?php
require('database.php');

$queryContacts = $pdo->prepare('SELECT * FROM contact');
$queryContacts->execute();
$contacts = $queryContacts->fetchAll(PDO::FETCH_ASSOC);





$title = "Gestionnaire de danse - Liste des contacts";
include('header_technique.php');
?>
<body>
<?php
$h1 = "Liste des contacts";
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
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>&Eacute;dition</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($contacts as $cr )
            {
                echo "<tr>";
                echo "<td>".$cr['id']."</td>";
                echo "<td>".$cr['nom']."</td>";
                echo "<td>".$cr['prenom']."</td>";
                echo "<td>".$cr['email']."</td>";
                echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_contact.php?id_contact=".$cr['id']."'\" value='Modifier' /></td>";
                echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_contact.php?id_contact=".$cr['id']."'\" value='Supprimer' /></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <input class="btn right" type="button" onclick="window.location.href='form_contact.php'" value="Créer un contact" />
    </div>
</main>
</body>
</html>