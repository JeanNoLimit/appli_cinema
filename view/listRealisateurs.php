<?php ob_start();?>

<p class="compteur">Il y a <?= $requete->rowcount() ?> réalisteurs/réalisatrices </p>

<table class="table_affichage">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $real){?>
            <tr>
                <td><?= $real['prenom'] ?></td>
                <td><?= $real['nom'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
    $titre="Liste des réalisteurs/réalisatrices";
    $titre_secondaire="Liste des réalisteurs/réalisatrices";
    $contenu=ob_get_clean();
    require "view/template.php";
?>