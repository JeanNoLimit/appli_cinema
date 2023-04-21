<?php ob_start()?>

<div class="formulaire">
    <form action="" method="post">
        <div>
            <label for="titre">Titre : 
                <input type="text" name="titre" id="titre" maxlength="50">
            </label>
        </div>
        <div>
            <label for="genre">genres : </label>
            <select name="genre" id="id_genre">
                <!-- INSERER LA LISTE DES GENRES A L'AIDE D'UNE REQUETE -->
            </select>
            <p class="info_complémentaire">Pour selectionner plusieurs genres : "ctrl + clic-gauche" </p>
        </div>
        <div>
            <label for="duree">
                Durée : 
                <input type="number" name="duree" id="duree" step="1" min="0">
            </label>   
        </div>
        <div>
            <label for="realisateur">Réalisateur : </label>
            <select name="realisateur" id="id_realisateur">
                <!-- INSERER LA LISTE DES GENRES A L'AIDE D'UNE REQUETE -->
            </select>
            <p class="info_complémentaire">Si le réalisateur n'apparait pas dans la liste veuillez remplir le formulaire d'ajout de réalisteur en cliquant ici.</p>    
        </div>
        <div>
            <label for="affiche">Insérer une affiche : (Optionnel)</label>
            <input type="file" name="affiche" id="affiche" accept=".png, .jpeg, .jpg">
        </div>

    </form>
</div>

<?php
$titre="Formulaire film";
$titre_secondaire="Formulaire de saisie d'un nouveau film";
$contenu=ob_get_clean();
require "view/template.php";
?>