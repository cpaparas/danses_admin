<?php
require('database.php');
$query = $pdo->prepare('SELECT c.id, DATE_FORMAT(c.date, "%d/%m/%Y") AS date, c.commentaires, g.nom FROM `cours` AS c, `groupes` AS g WHERE g.id = c.id_groupe');

$query->execute();
$cours = $query->fetchAll(PDO::FETCH_ASSOC);

$title = "Gestionnaire de danse - Liste des cours";
include('header_technique.php');
?>
<body>
	<?php
		$h1 = "Liste des cours";
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
				<th>Date</th>
                <th>Groupe</th>
				<th>&Eacute;dition</th>
                <th>Suppression</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($cours as $cr )
				{
					echo "<tr>";
					echo "<td>".$cr['id']."</td>";
					echo "<td>Cours du ".$cr['date']."</td>";
                    echo "<td>".$cr['nom']."</td>";
					echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='form_cours.php?id_cours=".$cr['id']."'\" value='Modifier' /></td>";
                    echo "<td><input class='btn' type=\"button\" onclick=\"window.location.href='delete_cours.php?id_cours=".$cr['id']."'\" value='Supprimer' /></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<input class="btn right" type="button" onclick="window.location.href='form_cours.php'" value="Créer un cours" />
</div>
</main>
</body>
</html>