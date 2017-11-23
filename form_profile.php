<?php
require('database.php');

if (isset($_GET['id_profile'])) {
	$query = $pdo->prepare('SELECT * FROM profile WHERE id =?');

	$query->execute([$_GET['id_profile']]);

	$profile = $query->fetch(PDO::FETCH_ASSOC);

    $queryGrpProf = $pdo->prepare('SELECT id_groupe FROM profile_groupes WHERE id_profile =?');

    $queryGrpProf->execute([$_GET['id_profile']]);

    $grpes_prof = $queryGrpProf->fetchAll(PDO::FETCH_ASSOC);
}

$queryGrpe = $pdo->prepare('SELECT * FROM groupes');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

$title = "Gestionnaire de danse - Formulaire de profile";
include('header_technique.php');
?>

<body>
	<?php
		$h1 = "Gestion du profile";
		include('header.php');
	?>
	<main>
		<?php 
			include('nav.php');
		?>
		<div class="col-10 item ">
			<form id="form_profile" method="POST" action="save_profile.php">
				<p><i>Les champs suivis d'un * sont obligatoires</i></p>
                <div id="error">Veuillez vérifier que tous les champs obligatoires ont bien été saisis</div>
				<fieldset>
					<input type="hidden" name="id" id="id" value="<?=isset($_GET["id_profile"]) ? $_GET["id_profile"] : "" ?>">
					<input type="hidden" name="professeur" id="professeur" value="<?=isset($profile["professeur"]) ? $profile["professeur"] : "0" ?>">
					<input type="hidden" name="date_creation" id="date_creation" value="<?=isset($profile["date_creation"]) ? $profile["date_creation"] : date('Y-m-d H:i:s', time()) ?>">
                    <input type="hidden" name="date_modification" id="date_modification" value="<?=date('Y-m-d H:i:s', time()) ?>">
					<div class="form-group">
						<label for="email">Email * :</label>
						<input class='form-control' type="email" name="email" id="email" size="50" value="<?= isset($profile['email']) ? $profile['email'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="nom">Nom * :</label>
						<input class='form-control' type="text" name="nom" id="nom" size="50" value="<?= isset($profile['nom']) ? $profile['nom'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="prenom">Prénom * :</label>
						<input class='form-control' type="text" name="prenom" id="prenom" size="50" value="<?= isset($profile['prenom']) ? $profile['prenom'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="date_naissance">Date de naissance :</label>
						<input class='form-control' type="date" name="date_naissance" id="date_naissance" size="50" value="<?= isset($profile['date_naissance']) ? $profile['date_naissance'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="date_arrivee">Date d'arrivée :</label>
						<input class='form-control' type="date" name="date_arrivee" id="date_arrivee" size="50" value="<?= isset($profile['date_arrivee']) ? $profile['date_arrivee'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="date_depart">Date de départ :</label>
						<input class='form-control' type="date" name="date_depart" id="date_depart" size="50" value="<?= isset($profile['date_depart']) ? $profile['date_depart'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="adresse">Adresse :</label>
						<input class='form-control' type="text" name="adresse" id="adresse" value="<?= isset($profile['adresse']) ? $profile['adresse'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="code_postal">Code Postal :</label>
						<input class='form-control' type="text" name="code_postal" id="code_postal" size="5" value="<?= isset($profile['code_postal']) ? $profile['code_postal'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="ville">Ville :</label>
						<input class='form-control' type="text" name="ville" id="ville" value="<?= isset($profile['ville']) ? $profile['ville'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="pays">Pays :</label>
						<input class='form-control' type="text" name="pays" id="pays" value="<?= isset($profile['pays']) ? $profile['pays'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="telephone">Téléphone :</label>
						<input class='form-control' type="text" placeholder="+33 6 24 55 88 88" name="telephone" id="telephone" value="<?= isset($profile['telephone']) ? $profile['telephone'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="pointure">Pointure :</label>
						<input class='form-control' type="text" placeholder="43" name="pointure" id="pointure" value="<?= isset($profile['pointure']) ? $profile['pointure'] : '' ?>">
					</div>
					<div class="form-group">
						<label for="taille">Taille (en cm) :</label>
						<input class='form-control' type="text" placeholder="186" name="taille" id="taille" value="<?= isset($profile['taille']) ? $profile['taille'] : '' ?>">
					</div>
					<div class="checkbox">
						<label for="cb_professeur">Professeur</label>
						<input type="checkbox" id="cb_professeur" name="cb_professeur" <?= isset($profile['professeur']) && $profile['professeur'] ? 'checked="checked"' : '' ?>>
					</div>
					<div class="form-group" id="gropupes_profs">
						<label for="id_groupe_prof">Pour le groupe :</label>
						<select id="id_groupe_prof" name="id_groupe_prof" class='form-control'>
							<option value="">---------------</option>
							<?php
								if ($groupes) {
									foreach ($groupes as $grpe) {
										echo '<option value="'.$grpe['id'].'" ';
										if (isset($profile["id_groupe_prof"]) && $grpe["id"] == $profile["id_groupe_prof"]) {
											echo "selected='selected'";
										} 
										echo '>'.$grpe['nom'].'</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="checkbox">
						<label for="groupes[]">Groupes : </label><br />
						<?php
							if ($groupes) {
								foreach ($groupes as $grpe) {
									echo '<input type="checkbox" value="'.$grpe['id'].'" ';
									if (isset($grpes_prof)) {
									    foreach ($grpes_prof as $gp) {
									        if ($grpe['id'] == $gp['id_groupe']) {
                                                echo "checked='checked'";
                                            }
                                        }
                                    }
									echo 'id="groupes[]" name="groupes[]"> '.$grpe['nom'].'<br />';
								}
							}
						?>
					</div>
					<div class="form-group">
						<label for="commentaires">Commentaires :</label>
						<textarea class="form-control" rows="5" id="commentaires" name="commentaires"></textarea>
					</div> 
					<input type="submit" name="submit_profile" value="Enregistrer">
				</fieldset>
			</form>
		</div>
	</main>
	<script type="text/javascript" src="js/profile.js"></script>
</body>
</html>