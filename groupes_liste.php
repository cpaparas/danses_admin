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
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=GFS+Didot|Hammersmith+One" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
	<link href="css/transverse.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">
</head>
<body>
	<?php
		$h1 = "Liste des groupes";
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
				<th>Horaires</th>
				<th>Lieu</th>
				<th>&Eacute;dition</th>
                <th>Suppression</th>
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
                    echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_groupe.php?id_groupe=".$groupe['id']."'\" value='Supprimer' /></td>";
                    echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<input class="btn right" type="button" onclick="window.location.href='form_groupe.php'" value="Créer un groupe" />
</div>
</main>
</body>
</html>