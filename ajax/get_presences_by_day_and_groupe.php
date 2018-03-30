<?php
require('../database.php');
$queryGrpe = $pdo->prepare('SELECT * FROM groupes ORDER BY id ASC');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

$csv = "date,deb,inter,conf,chant\n";

$query = $pdo->prepare('SELECT c.date AS cours_date, c.id_groupe, count(cp.id_profile) AS presences FROM cours AS c, cours_presences AS cp WHERE cp.id_cours = c.id GROUP BY c.date, c.id_groupe ORDER BY c.date, c.id_groupe ASC ');
$query->execute();
$aPresences = $query->fetchAll(PDO::FETCH_ASSOC);

$aDatas = array();
/*
if ($groupes) {
    foreach ($groupes as $groupe) {
        $csv .= ",".$groupe['nom'];
    }
}
$csv .="\n";
*/

if ($groupes && $aPresences) {
    foreach ($groupes as $groupe) {
        foreach ($aPresences as $pres) {
            if ($pres['id_groupe'] == $groupe['id']) {
                $aDatas[$pres['cours_date']][$groupe['id']] = $pres['presences'];
            } elseif (!isset($aDatas[$pres['cours_date']][$groupe['id']])) {
                $aDatas[$pres['cours_date']][$groupe['id']] = 0;
            }
        }
    }
}

if ($aDatas) {
    foreach ($aDatas as $key => $pres) {
        $csv .= $key;
        if (is_array($pres)) {
            foreach ($pres as $p => $val) {
                $csv .= ",".$val;
            }
        }
        $csv .= "\n";
    }
}

echo utf8_decode($csv);