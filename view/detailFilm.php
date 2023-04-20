<?php ob_start();?>

<div class="conteneur_film">
    <div class="affiche">
    </div>
    <div class ="infos_film">
         <?php $film=$requete_film->fetch(); {?>
            <h2><?=$film['titre']?></h2>
        <div class="details_film">       
            <p>Date de sortie : <?=$film['date_sortie']?></p>
            <p>genre : <?=$film['libelle_genre']?> </p>
            <p>Durée : <?=$film['duree']?> </p>
            <p>Réalisateur : <?=$film['prenom']?> <?=$film['nom']?> </p>
            <p>Note : <?=$film['note']?> /5</p>
        <?php } ?>
        </div>
    </div>
</div>

<h1 id="titre_casting">Casting</h1>

<table class="table_affichage">
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach( $requete_casting->fetchAll() as $casting){?>
            <tr>
                <td><?= $casting['prenom'] ?> <?= $casting['nom'] ?></td>
                <td><?= $casting['nom_role']?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php

$contenu=ob_get_clean();
$titre="détail film";
$titre_secondaire="";
require "view/template.php";
?>