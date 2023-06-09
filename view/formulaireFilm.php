<?php ob_start()?>

<div class="formulaire formulaire_film">
    <h3>Formulaire de saisie : <br> Nouveau film </h3>
    <!-- Pour pouvoir soumettre un formulaire avec un type file il faut rajouer l'attribut enctype="multipart/form-data" dans la balise form -->
    <form action="index.php?action=formulaireFilm" method="post" enctype="multipart/form-data"> 

        <div>
            <label for="titre" class="label">Titre : 
                <input type="text" name="titre" id="titre" maxlength="50">
            </label>
        </div>

        <div>
            <label for="genre" class="label">genres : </label>
            <select name="id_genres[]" id="genre" multiple size="3">
                <?php foreach($requete_genre->fetchAll() as $genre){?>
                        <option value="<?=$genre['id']?>"><?=$genre['libelle_genre'] ?></option>
                <?php } ?>
            </select>
            <p class="info_complementaire">Pour selectionner plusieurs genres : "ctrl + clic-gauche" </p>
        </div>

        <div>
        <label for="date_sortie" class="label">Date de sortie :
                <input type="date" name="date_sortie" id="date_sortie" min="1895-03-22">
            </label>
        </div>

        <div>
            <label for="duree" class="label">Durée :</label>   
                <input type="number" name="duree" id="duree" step="1" min="0" max="1265" maxlength="4" class="form_num" > min
        </div>
        <div>
            <label for="realisateur" class="label">Réalisateur : </label>
                <select name="id_realisateur" id="realisateur">
                    <?php foreach($requete_real->fetchAll() as $real){?>
                        <option value="<?=$real['id_realisateur']?>"><?=$real['prenom']?> <?=$real['nom']?></option>
                    <?php } ?>
                </select>
            <p class="info_complementaire">Si le réalisateur n'apparait pas dans la liste veuillez remplir le formulaire d'ajout de réalisteur en <a href="index.php?action=formulairePersonne"> cliquant ici.</a></p>    
        </div>
        
        <div>
            <label for="synopsis" class=label> Synopsis : </label>
            <textarea name="synopsis" id="synopsis" ></textarea>
        </div>
        <div>
            <label for="affiche" class="label">Insérer une affiche (1Mo. max) : </label><span class="info_complementaire">(Optionnel)</span>
                <input type="file" name="affiche" id="affiche" accept=".png, .jpeg, .jpg, .gif">
        </div> 

        <div>
            <label for="note" class="label">Note : </label><span class="info_complementaire">(Optionnel)</span>
                <input type="number" name="note" id="note" min="0" max="5" step="0.1" class="form_num"> /5  
        </div>
        <input type="submit" value="Ajouter" name="submitFilm" class="button">
    </form>
</div>

<?php
$titre="Formulaire film";
$titre_secondaire="Formulaire de saisie d'un nouveau film";
$contenu=ob_get_clean();
require "view/template.php";
?>