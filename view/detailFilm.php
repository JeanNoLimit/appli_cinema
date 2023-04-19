<?php ob_start();?>

<h1>TEST</h1>





<?php

$contenu=ob_get_clean();
$titre="détail film";
$titre_secondaire="";
require "view/template.php";
?>