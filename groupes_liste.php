<?php
require('database.php');
$query = $pdo->prepare('SELECT id,nom,jour, TIME_FORMAT(heure_debut,"%Hh%i") AS heure_debut, TIME_FORMAT(heure_fin,"%Hh%i") AS heure_fin, adresse, code_postal, ville FROM `groupes`');

$query->execute();
$groupes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Liste des groupes</title>
	<link href="css/transverse.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">
</head>
<body>
	<table>
		<caption>Liste de groupes</caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Horaires</th>
				<th>Lieu</th>
				<th>&Eacute;dition</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($groupes as $groupe )
				{
					echo "<tr>";
					echo "<td>".$groupe['id']."</td>";
					echo "<td>".$groupe['nom']."</td>";
					echo "<td>Le ".$groupe['jour']." de ".$groupe['heure_debut']." à ".$groupe['heure_fin']."</td>";
					echo "<td>Au ".$groupe['adresse']." ".$groupe['code_postal']." ".$groupe['ville']."</td>";
					echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_groupe.php?id_groupe=".$groupe['id']."'\" value='Modifier' /></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<input class="btn right" type="button" onclick="window.location.href='form_groupe.php'" value="Créer un groupe" />
</body>
</html>