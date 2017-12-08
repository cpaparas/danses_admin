<?php
require('database.php');
if ($_POST["id"] != "")
{
	$query = $pdo->prepare('UPDATE `profile` SET `nom`=?, `prenom`=?, `email`=?,`date_naissance`=?, `date_arrivee`=?, `date_depart`=?, `adresse`=?, `code_postal`=?, `ville`=?, `pays`=?, `telephone`=?, `pointure`=?, `taille`=?, `professeur`=?, `id_groupe_prof`=?, `commentaire`=?,`date_creation`=?, `date_modification`=? WHERE id =?'
       	);
	$query->execute(array(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['date_naissance'],
            $_POST['date_arrivee'],
            $_POST['date_depart'],
            $_POST['adresse'],
            $_POST['code_postal'],
            $_POST['ville'],
            $_POST['pays'],
            $_POST['telephone'],
            (int)$_POST['pointure'],
            (int)$_POST['taille'],
            (int)$_POST['professeur'],
            (int)$_POST['id_groupe_prof'],
            $_POST['commentaires'],
            $_POST['date_creation'],
            $_POST['date_modification'],
			$_POST['id']
		));
	if ($_POST["groupes"]) {
		$queryDelete = $pdo->prepare('DELETE FROM `profile_groupes` WHERE id_profile=?');
        $queryDelete->execute(array($_POST["id"]));



		foreach ($_POST["groupes"] AS $key => $val) {
			$queryGrpe = $pdo->prepare('INSERT INTO `profile_groupes` (`id_profile`, `id_groupe`) VALUES (?,?)');
			$queryGrpe->execute(array((int)$_POST["id"],(int)$val));
		}
	}
}
else {

	$query = $pdo->prepare('INSERT INTO `profile` (`nom`, `prenom`, `email`,`date_naissance`, `date_arrivee`, `date_depart`, `adresse`, `code_postal`, `ville`, `pays`, `telephone`, `pointure`, `taille`, `professeur`, `id_groupe_prof`, `commentaire`,`date_creation`, `date_modification`) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
       	);
	$query->execute(array(
			$_POST['nom'], 
			$_POST['prenom'], 
			$_POST['email'], 
			$_POST['date_naissance'],
			$_POST['date_arrivee'],
			$_POST['date_depart'],
			$_POST['adresse'], 
			$_POST['code_postal'], 
			$_POST['ville'], 
			$_POST['pays'],
			$_POST['telephone'],
			(int)$_POST['pointure'],
			(int)$_POST['taille'],
			(int)$_POST['professeur'],
			(int)$_POST['id_groupe_prof'],
			$_POST['commentaires'],
            $_POST['date_creation'],
            $_POST['date_modification']
		));
	
	if ($_POST["groupes"]) {
		$queryId = $pdo->prepare('SELECT id FROM `profile` WHERE email=? AND nom=?');
		$queryId->execute(array($_POST['email'], 
				$_POST['nom']));
		
		$id =$queryId->fetch(PDO::FETCH_ASSOC);
		
		foreach ($_POST["groupes"] AS $key => $val) {
			$queryGrpe = $pdo->prepare('INSERT INTO `profile_groupes` (`id_profile`, `id_groupe`) VALUES (?,?)');
			$queryGrpe->execute(array((int)$id['id'],(int)$val));
		}
	}
}
header('Location: profiles_liste.php');