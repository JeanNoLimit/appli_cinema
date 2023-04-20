<?php ob_start();?>



<div id="page_genre">
    <div class="conteneur_genre">
        <ul>
            <?php 
                foreach($requete_genre->fetchAll() as $genre) {?>
                    <li><a href="index.php?action=listGenres&id=<?=$genre['id']?>"><?=$genre['libelle_genre']?> (<?=$genre['filmParGenre']?>)</a></li>
            <?php }?>
        </ul>
    </div>
    
    <?php if(isset($_GET["id"])){?> <!-- Affichage du tableau uniquement si un genre a été selectionné -->
    <table class="table_affichage table_genre">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody><?php };?>
           <?php foreach($requete_liste->fetchAll() as $film) {?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?=$film['id_film']?>"> <?= $film['titre'] ?> </a></td>
                    <td> <?= $film['anne_sortie'] ?></td>
                </tr>
        <?php }; ?>
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