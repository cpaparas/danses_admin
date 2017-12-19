<?php
require('database.php');

$queryContacts = $pdo->prepare('SELECT * FROM users');
$queryContacts->execute();
$contacts = $queryContacts->fetchAll(PDO::FETCH_ASSOC);





$title = "Gestionnaire de danse - Liste des utilisateurs";
include('header_technique.php');
?>
<body>
<?php
$h1 = "Liste des utilisateurs";
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
                <th>Utilisateur</th>
                <th>&Eacute;dition</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($contacts as $cr )
            {
                echo "<tr>";
                echo "<td>".$cr['username']."</td>";
                echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_user.php?user=".$cr['username']."'\" value='Modifier' /></td>";
                echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_user.php?user=".$cr['username']."'\" value='Supprimer' /></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <input class="btn right" type="button" onclick="window.location.href='form_user.php'" value="Créer un utilisateur" />
    </div>
</main>
</body>
</html>