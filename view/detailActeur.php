<?php ob_start()?>

<div class=conteneur_infos>
    <?php $acteur=$requete_infoActeur->fetch(); {?>
    <h2><?=$acteur['prenom'].' '.$acteur['nom'];?></h2>
    <p>Né(e) le <?=$acteur['date_Nais']?></p>
    <?php }; ?>
    <h3>Acteur/Actrice</h3>
</div>
<table class="table_affichage">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Rôle</th>
            <th>Année</th>
            <th>note</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete_filmoActeur->fetchAll() as $filmographie){ ?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?=$filmographie['id_film']?>"><?= $filmographie['titre']?></td>
                    <td><?=$filmographie['nom_role']?></td>
                    <td><?=$filmographie['annee_sortie']?></td>
                    <td><?=$filmographie['note']?> /5</td>
                </tr>
        <?php } ?>
    </tbody>
</table>




<?php
$titre="Filmographie "; // Ajouter nom prenom du réal une fois que la requête sera intégrée à la page
$titre_secondaire="";
$contenu=ob_get_clean();
require "view/template.php";
?>