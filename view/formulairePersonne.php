<?php ob_start()?>

<div class="formulaire">
    <h3>Formulaire de saisie : <br> Nouveau réalisateur/acteur </h3>
    <form action="#" method="post">
        <div>
            <label for="nom" class="label">Nom : </label>
                <input type="text" name="nom" id="nom" maxlength="30">            
        </div>

        <div>
            <label for="prenom" class="label">Prénom :</label>
                <input type="text" name="prenom" id="prenom" maxlength="30">
        </div>

        <div>
            <label for="date_naissance" class="label">Date de naissance :</label>
                <input type="date" name="date_naissance" id="date_naissance" min="1862-10-19">    
        </div>

        <div>
            <p class="label">Sexe : </p>
            <input type="radio" name="sexe" id="homme" value="M">
                <label for="homme">homme</label>
            <input type="radio" name="sexe" id="femme" value="F">
                <label for="femme">femme</label>
        </div>
        
        
        <div>
            <p class="label">Métier(s) : </p>
            <input type="checkbox" name="realisateur" id="realisateur">
                <label for="realisateur">réalisateur</label>
            <input type="checkbox" name="acteur" id="acteur">
                <label for="acteur">acteur</label>
        </div>
        
        <button type="submit" name="submit">Envoyer</button>
    </form>
</div>



<?php
$titre="Formulaire Réalisateur/Acteur";
$titre_secondaire="Formulaire de saisie nouveau Acteur/Réalisateur";
$contenu=ob_get_clean();
require "view/template.php";
?>