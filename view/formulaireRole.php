<?php ob_start(); ?>


<div class="formulaire formulaire_sm">
    <h3>Formulaire de saisie : <br> Nouveau rôle </h3>
    <form action="index.php?action=formulaireRole" method="post">

        <div>
            <label for="role" class="label">Nom du rôle : 
                <input type="text" name="nom_role" id="role" maxlength="50">
            </label>
        </div>

       <input type="submit" value="Envoyer" name="submitRole" class="button">

    </form>
</div>




<?php

$titre="Formulaire Nouveau rôle";
$titre_secondaire="Formulaire de saisie d'un nouveau rôle";
$contenu=ob_get_clean();
require "view/template.php";