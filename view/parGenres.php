<?php ob_start();?>

<p class="compteur">Il y a <?= $requete->rowCount() ?> genres</p>

<div id="page_genre">
    <div class="conteneur_genre">
        <ul>
            <?php 
                foreach($requete->fetchAll() as $genre) {?>
                    <li><?=$genre['genre']?> (<?=$genre['filmParGenre']?>)</li>
            <?php }?>
        </ul>
    </div>
</div>

<?php

$titre="Liste des films par genres";
$titre_secondaire="Liste des films par genres";
$contenu = ob_get_clean();
// injecte le contenu dans le template "squelette" ->template.php
require "view/template.php";

?>