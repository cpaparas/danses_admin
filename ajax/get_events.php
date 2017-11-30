<?php
require('../database.php');

$query = $pdo->prepare('SELECT c.id , CONCAT(\'Cours \',g.nom) as title, date AS start, NULL AS end, CONCAT("form_cours.php?id_cours=",c.id) AS url FROM `cours` AS c, `groupes` AS g WHERE c.id_groupe = g.id 
                                  UNION
                                  SELECT id, titre AS title, date_debut AS start, date_fin AS end, CONCAT("form_event.php?id_event=",id) AS url FROM `evenement`');
$query->execute();

$aEvents = $query->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($aEvents);