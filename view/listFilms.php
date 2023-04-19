<!-- temporisation de sortie -->
<?php ob_start();?>

<p class="compteur">Il y a <?= $requete->rowCount() ?> films</p>

<table class="table_affichage">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Réalisateur</th>
            <th>Année de sortie</th>
            <th>Durée</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) {?>
                <tr>
                    <td class="titre_film"> <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>"> <?= $film['titre'] ?></a></td>
                    <td> <?= $film['nom']." ". $film['prenom'] ?></td>
                    <td> <?= $film['anne_sortie'] ?></td>
                    <td> <?= $film['duree'] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre="Liste des films";
$titre_secondaire="Liste des films";
$contenu = ob_get_clean();
// injecte le contenu dans le template "squelette" ->template.php
require "view/template.php";

?>