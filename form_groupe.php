<?php
require('database.php');

if (isset($_GET['id_groupe'])) {
	$query = $pdo->prepare('SELECT * FROM groupes WHERE id =?');

	$query->execute([$_GET['id_groupe']]);

	$groupe = $query->fetch(PDO::FETCH_ASSOC);

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>formulaire du groupe</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=GFS+Didot|Hammersmith+One" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
		$h1 = "Formulaire du groupe";
		include('header.php');
	?>
	<main>

		<?php 
			include('nav.php');
		?>
		<div class="col-10 item ">
			<form id="form_groupe" method="POST" action="save_groupe.php">
				<fieldset>

					<input type="hidden" name="id" id="id" value="<?=isset($_GET["id_groupe"]) ? $_GET["id_groupe"] : "" ?>">

					<div class="form-group">
						<label for="nom">Nom * :</label>
						<input class='form-control' type="text" name="nom" id="nom" size="50" value="<?= isset($groupe['nom']) ? $groupe['nom'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="jour">Jour :</label>
						<input class='form-control' type="text" name="jour" id="jour" size="10" value="<?= isset($groupe['jour']) ? $groupe['jour'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="heure_debut">Heure de debut :</label>
						<input class='form-time' type="time" name="heure_debut" id="heure_debut" value="<?= isset($groupe['heure_debut']) ? $groupe['heure_debut'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="heure_fin">Heure de fin :</label>
						<input class='form-time' type="time" name="heure_fin" id="heure_fin" value="<?= isset($groupe['heure_fin']) ? $groupe['heure_fin'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="adresse">Adresse :</label>
						<input class='form-control' type="text" name="adresse" id="adresse" value="<?= isset($groupe['adresse']) ? $groupe['adresse'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="code_postal">Code Postal:</label>
						<input class='form-control' type="text" name="code_postal" id="code_postal" size="5" value="<?= isset($groupe['code_postal']) ? $groupe['code_postal'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="ville">Ville :</label>
						<input class='form-control' type="text" name="ville" id="ville" value="<?= isset($groupe['ville']) ? $groupe['ville'] : '' ?>">
					</div>
					
						<input type="submit" name="submit_groupe" value="Enregistrer">

				</fieldset>
			</form>
		</div>
	</main>
</body>
</html>