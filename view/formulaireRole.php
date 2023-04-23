<?php ob_start(); ?>


<div class="formulaire">
    <form action="" method="post">

        <div>
            <label for="role" class="label">Nom du rôle : 
                <input type="text" name="nom_role" id="role" maxlength="50">
            </label>
        </div>

       <button type="submit" name="submit">Envoyer</button>

    </form>
</div>




<?php

$titre="Formulaire Nouveau rôle";
$titre_secondaire="";
$contenu=ob_get_clean();
require "view/template.php";