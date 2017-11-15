<?php
require('database.php');
$query = $pdo->prepare('SELECT * FROM `profiles`');

$query->execute();
$profiles = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Liste des profiles</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=GFS+Didot|Hammersmith+One" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
	<link href="css/transverse.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">
</head>
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
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>&Eacute;dition</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($profiles as $profile )
				{
					echo "<tr>";
					echo "<td>".$profile['id']."</td>";
					echo "<td>".$profile['nom']."</td>";
					echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_profile.php?id_profile=".$profile['id']."'\" value='Modifier' /></td>";
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