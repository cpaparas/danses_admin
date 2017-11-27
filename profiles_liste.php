<?php
require('database.php');
$query = $pdo->prepare('SELECT * FROM `profile`');

$query->execute();
$profiles = $query->fetchAll(PDO::FETCH_ASSOC);

$title = "Gestionnaire de danse - Liste des profiles";
include('header_technique.php');
?>
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
                <th>Préom</th>
                <th>Email</th>
                <th>&Eacute;dition</th>
                <th>Suppression</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($profiles as $profile )
				{
					echo "<tr>";
					echo "<td>".$profile['id']."</td>";
					echo "<td>".$profile['nom']."</td>";
                    echo "<td>".$profile['prenom']."</td>";
                    echo "<td>".$profile['email']."</td>";
					echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_profile.php?id_profile=".$profile['id']."'\" value='Modifier' /></td>";
                    echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_profile.php?id_profile=".$profile['id']."'\" value='Supprimer' /></td>";
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