<?php
require('database.php');

if ($_POST["id"] != "") 
{
	/*mise a jour*/
	$query = $pdo->prepare('UPDATE `groupes` SET `nom`=?, `heure_debut`=?, `heure_fin`=?, `adresse`=?, `code_postal`=?, `ville`=?, `jour`=? WHERE id =?'
       	);
	$query->execute(array(
			$_POST['nom'], 
			$_POST['heure_debut'], 
			$_POST['heure_fin'], 
			$_POST['adresse'],
			$_POST['code_postal'],
			$_POST['ville'],
			$_POST['jour'],
			$_POST['id']
		));

}
else {
	/*insertion*/
	$query = $pdo->prepare('INSERT INTO `groupes` (`nom`, `heure_debut`, `heure_fin`, `adresse`, `code_postal`, `ville`, `jour`) VALUES (?, ?, ?, ?, ?, ?, ?)'
       	);
	$query->execute(array(
			$_POST['nom'], 
			$_POST['heure_debut'], 
			$_POST['heure_fin'], 
			$_POST['adresse'],
			$_POST['code_postal'],
			$_POST['ville'],
			$_POST['jour']

		));
}
header('Location: groupes_liste.php');

?>