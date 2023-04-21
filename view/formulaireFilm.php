<?php ob_start()?>



<?php
$titre="Formulaire film";
$titre_secondaire="Formulaire de saisie d'un nouveau film";
$contenu=ob_get_clean();
require "view/template.php";
?>