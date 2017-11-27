<?php
require('../database.php');
$html = '';
if (isset($_POST['id_cours']) && $_POST['id_cours'] != "") {
    $queryPresencesCours = $pdo->prepare('SELECT id_profile FROM cours_presences WHERE id_cours=?');
    $queryPresencesCours->execute(array($_POST['id_cours']));
    $aPresences = $queryPresencesCours->fetchAll(PDO::FETCH_ASSOC);
} else {
    $aPresences = array();
}
if (isset($_POST['id_groupe'])) {
    $queryProfByGrpe = $pdo->prepare('SELECT id, nom, prenom FROM profile_groupes, profile WHERE id_groupe=? AND id = id_profile');

    $queryProfByGrpe->execute([$_POST['id_groupe']]);

    $profilesByGroupe = $queryProfByGrpe->fetchAll(PDO::FETCH_ASSOC);

    if ($profilesByGroupe) {
        $html = "<label for=\"presences[]\">Présences : </label><br />";
        foreach ($profilesByGroupe as $profile) {
            $html .= '<input type="checkbox" value="'.$profile['id'].'" ';
            if (isset($aPresences)) {
                foreach ($aPresences as $pres) {
                    if ($profile['id'] == $pres['id_profile']) {
                        $html .= "checked='checked'";
                    }
                }
            }
            $html .= 'id="presences[]" name="presences[]"> '.$profile['nom'].' '.$profile['prenom'].'<br />';
        }
    }
}
$html .= "<br />";
echo $html;