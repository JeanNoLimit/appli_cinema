<?php ob_start();?>

<div class=conteneur_infos>
    <?php $role=$requete_infoRole->fetch() ?>
    <h2><?=$role['nom_role']?></h2>
</div>

<table class="table_affichage">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année</th>
            <th>Acteur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($requete_listRole->fetchAll() as $listRole){?>
            <tr>
                <td><?=$listRole['titre'] ?></td>
                <td><?=$listRole['annee_sortie']?></td>
                <td><?=$listRole['prenom'].' '.$listRole['nom']?></td>
            </tr>
        <?php } ?>
    </tbody>





<?php
$titre="Détails rôle";
$titre_secondaire="";
$contenu = ob_get_clean();
// injecte le contenu dans le template "squelette" ->template.php
require "view/template.php";
?>