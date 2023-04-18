<!-- temporisation de sortie -->
<?php ob_start();?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<table class="uk-table uk-table-striped">
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
                    <td> <?= $film['titre'] ?></td>
                    <td> <?= $film['nom']." ". $film['prenom'] ?></td>
                    <td> <?= $film['anne_sortie'] ?></td>
                    <td> <?= $film['duree'] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$title="Liste des films";
$titre_secondaire="Liste des films";
$contenu = ob_get_clean();
require "view/template.php";

?>