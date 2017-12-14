<?php
require('../database.php');
$csv = "groupe,danseurs\n";
$query = $pdo->prepare('SELECT count(pg.id_profile) AS danseurs, g.nom as groupe FROM profile_groupes AS pg, groupes AS g WHERE g.id = pg.id_groupe GROUP BY g.nom');
$query->execute();

$aDanseus = $query->fetchAll(PDO::FETCH_ASSOC);
if ($aDanseus) {
    foreach ($aDanseus as $d) {
        $csv .= $d['groupe'].",".$d['danseurs']."\n";
    }
}

echo $csv;