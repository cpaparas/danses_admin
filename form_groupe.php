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
</head>
<body>
	<form id="form_groupe" method="POST" action="save_groupe.php">
		<fieldset>
			<legend>Formulaire Groupe</legend>

			<label for="nom">Nom * :</label>
			<input type="text" name="nom" id="nom" size="50" value="<?= isset($groupe['nom']) ? $groupe['nom'] : '' ?>">

			<label for="jour">Jour :</label>
			<input type="text" name="jour" id="jour" size="10" value="<?= isset($groupe['jour']) ? $groupe['jour'] : '' ?>">

			<label for="heure_debut">Heure de debut :</label>
			<input type="time" name="heure_debut" id="heure_debut" value="<?= isset($groupe['heure_debut']) ? $groupe['heure_debut'] : '' ?>">

			<label for="heure_fin">Heure de fin :</label>
			<input type="time" name="heure_fin" id="heure_fin" value="<?= isset($groupe['heure_fin']) ? $groupe['heure_fin'] : '' ?>">

			<label for="adresse">Adresse :</label>
			<input type="text" name="adresse" id="adresse" value="<?= isset($groupe['adresse']) ? $groupe['adresse'] : '' ?>">

			<label for="code_postal">Code Postal:</label>
			<input type="text" name="code_postal" id="code_postal" size="5" value="<?= isset($groupe['code_postal']) ? $groupe['code_postal'] : '' ?>">

			<label for="ville">Ville :</label>
			<input type="text" name="ville" id="ville" value="<?= isset($groupe['ville']) ? $groupe['ville'] : '' ?>">

			<input type="hidden" name="id" id="id" value="<?=isset($_GET["id_groupe"]) ? $_GET["id_groupe"] : "" ?>">
			<input type="submit" name="submit_groupe" value="Enregistrer">


		</fieldset>
	</form>
</body>
</html>