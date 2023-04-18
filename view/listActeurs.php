<?php ob_start();?>

<p class="compteur">Il y a <?= $requete->rowCount() ?> acteurs</p>

<table>
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $acteur) {?>
                    <tr>
                        <td><?=$acteur['prenom']?></td>
                        <td><?=$acteur['nom']?></td>
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