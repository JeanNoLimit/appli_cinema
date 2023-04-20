<?php ob_start()?>

<div class=conteneur_infos>
    <?php $real=$requete_infoReal->fetch(); {?>
    <h2><?=$real['prenom'].' '.$real['nom'];?></h2>
    <p>Né(e) le <?=$real['date_Nais']?></p>
    <?php }; ?>
    <h3>Réalisateur/Réalisatrice</h3>
</div>





<?php
$titre="détail Réalisateur"; // Ajouter nom prenom du réal une fois que la requête sera intégrée à la page
$titre_secondaire="";
$contenu=ob_get_clean();
require "view/template.php";
?>