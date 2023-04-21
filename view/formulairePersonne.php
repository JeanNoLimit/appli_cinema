<?php ob_start()?>




<?php
$titre="Formulaire Réalisateur/Acteur";
$titre_secondaire="Formulaire de saisie nouveau Acteur/Réalisateur";
$contenu=ob_get_clean();
require "view/template.php";
?>