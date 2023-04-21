<?php ob_start();?>

<p class="compteur">Il y a <?= $requete->rowCount() ?> acteurs</p>

<table class="table_affichage">
    <thead>
        <tr>
            <th>Prénom, Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $acteur) {?>
                    <tr>
                        <td><a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>"><?=$acteur['prenom']?> <?=$acteur['nom']?><a></td>
                    </tr>       
      <?php  } ?>
    </tbody>
</table>

<?php
$titre="Liste des acteurs";
$titre_secondaire="Liste des acteurs";
$contenu = ob_get_clean();
// injecte le contenu dans le template "squelette" ->template.php
require "view/template.php";
?>