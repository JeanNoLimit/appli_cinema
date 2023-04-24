<?php ob_start(); ?>

<div class="formulaire">
    <form action="index.php?action=forumlaireCasting" method="post">
    <!-- Liste des films -->
    <div>
        <label for="film" class="label">Film : </label>
            <select name="id_film" id="film">
                <?php foreach($requete_film->fetchAll() as $film){?>
                    <option value="<?=$film['id_film']?>"><?=$film['titre']?></option>
                <?php } ?>
            </select>      
    </div>
    <!-- Liste des acteurs  -->
    <div>
        <label for="acteur" class="label">Acteur/Actrice : </label>
            <select name="id_acteur" id="acteur">
                <?php foreach($requete_acteur->fetchAll() as $acteur){?>
                    <option value="<?=$acteur['id_acteur']?>"><?=$acteur['prenom']?> <?=$acteur['nom']?></option>
                <?php } ?>
            </select>      
    </div>
    <!-- Liste des rôles -->
    <div>
        <label for="role" class="label">Role : </label>
            <select name="id_role" id="role">
                <?php foreach($requete_role->fetchAll() as $role){?>
                    <option value="<?=$role['id_role']?>"><?=$role['nom_role']?></option>
                <?php } ?>
            </select>      
    </div>

       <input type="submit" value="Ajouter" name="submitCasting">

    </form>
</div>

<?php
$titre="Formulaire Casting";
$titre_secondaire="";
$contenu=ob_get_clean();
require "view/template.php";
?>