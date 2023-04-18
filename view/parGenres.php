<?php ob_start();?>

<p class="compteur">Il y a <?= $requete_genre->rowCount() ?> genres</p>

<div id="page_genre">
    <div class="conteneur_genre">
        <ul>
            <?php 
                foreach($requete_genre->fetchAll() as $genre) {?>
                    <li><a href="index.php?action=listGenres&id=<?=$genre['id']?>"><?=$genre['libelle_genre']?> (<?=$genre['filmParGenre']?>)</a></li>
            <?php }?>
        </ul>
    </div>
    <table class="table_affichage table_genre">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete_liste->fetchAll() as $film) {?>
                <tr>
                    <td> <?= $film['titre'] ?></td>
                    <td> <?= $film['anne_sortie'] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<?php

$titre="Liste des films par genres";
$titre_secondaire="Liste des films par genres";
$contenu = ob_get_clean();
// injecte le contenu dans le template "squelette" ->template.php
require "view/template.php";

?>