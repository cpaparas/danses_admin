<?php
if ( ! session_id() ) @ session_start();
if (! isset($h1)) {
    $h1 = "Bienvenue sur le gestionnaire de danse";
}
$bonjour = "";
if (isset($_SESSION["CONNECTED_USER"])) {
    $bonjour .= '<div class="hello"> Bonjour ';
    $bonjour .= $_SESSION["CONNECTED_USER"];
    $bonjour .= '</div>';
}
?>

<header>
		<h1 class="text-center"><?=$h1?></h1>
        <?=$bonjour?>
		
</header>