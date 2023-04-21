<?php ob_start()?>

<div class=conteneur_infos>
    <?php $real=$requete_infoReal->fetch(); {?>
    <h2><?=$real['prenom'].' '.$real['nom'];?></h2>
    <p>Né(e) le <?=$real['date_Nais']?></p>
    <?php }; ?>
    <h3>Réalisateur/Réalisatrice</h3>
</div>
<table class="table_affichage">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année</th>
            <th>Genre(s)</th>
            <th>note</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete_filmoReal as $filmographie){ ?>
                <tr>
                    <td><?= $filmographie['titre']?></td>
                    <td><?=$filmographie['annee_sortie']?></td>
                    <td><?=$filmographie['genres']?></td>
                    <td><?=$filmographie['note']?> /5</td>
                </tr>
        <?php } ?>
    </tbody>
</table>




<?php
$titre="détail Réalisateur"; // Ajouter nom prenom du réal une fois que la requête sera intégrée à la page
$titre_secondaire="";
$contenu=ob_get_clean();
require "view/template.php";
?>