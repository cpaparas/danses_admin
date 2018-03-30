<?php
require('../database.php');
if (isset($_GET["id_groupe"])) {
    $query = $pdo->prepare('SELECT c.date AS cours_date, count(distinct cp.id_profile) AS presences FROM cours AS c, cours_presences AS cp WHERE cp.id_cours = c.id AND c.id_groupe =? GROUP BY c.date ORDER BY c.date ASC ');
    $query->execute(array($_GET["id_groupe"]));
} else {
    $query = $pdo->prepare('SELECT c.date AS cours_date, count(distinct cp.id_profile) AS presences FROM cours AS c, cours_presences AS cp WHERE cp.id_cours = c.id GROUP BY c.date ORDER BY c.date ASC ');
    $query->execute();
}


$aPresences = $query->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($aPresences);