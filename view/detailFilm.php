<?php ob_start();?>

<div class="conteneur_film">
    <div class="header_conteneur_film">
        <div class="affiche">
        <?php $film=$requete_film->fetch(); {?>
            <img src="upload/<?=$film['affiche']?>" alt="affiche du film <?=$film['titre']?>">
        </div>
        <div class ="infos_film">

                <h2><?=$film['titre']?></h2>

            <div class="details_film">

                <p>Date de sortie : <?=$film['date_sortie']?></p>
                <p>genre : <?=$film['genres']?> </p>
                <p>Durée : <?=$film['duree']?> </p>
                <p>Réalisateur : <a href="index.php?action=detailReal&id=<?=$film['id_realisateur']?>"><?=$film['prenom']?> <?=$film['nom']?></a> </p>
                <?php if(!empty($film['note'])){?>
                    <p>Note : <?=$film['note']?> /5</p>  
                <?php } ?>   
            </div>
        </div>
    </div>

    <div class="synopsis">

        <?php if(!empty($film['synopsis'])){
            echo "<h2>Sysnopsis</h2>";
        }?>
        
        <p><?=$film['synopsis']?></p>
         <?php } ?>
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
                <td><a href="index.php?action=detailActeur&id=<?=$casting['id_acteur']?>"><?= $casting['prenom'] ?> <?= $casting['nom'] ?></a></td>
                <td><a href="index.php?action=detailRole&id=<?=$casting['id_role']?>"><?= $casting['nom_role']?></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php
$titre=$film['titre'];
$titre_secondaire="";
$contenu=ob_get_clean();

require "view/template.php";
?>