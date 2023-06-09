<?php
 require_once "services/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="/appli_cinema/public/css/style.css">
    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <nav>
           
            <div id="wrap">
                <img src="/appli_cinema/public/img/logo_cinema.png" alt="logo cinéma" class="logo">
                <ul class="navbar">
                    <li>
                        <a href="/appli_cinema/index.php?action=listFilms">Acceuil</a>
                    </li>
                    <li>
                        <a href="#" class="deroulant">Filtrer affichages  <span class="material-symbols-outlined">arrow_drop_down</span></a>
                        <ul>
                            <li><a href="/appli_cinema/index.php?action=listGenres">Par genres</a></li>
                            <li><a href="/appli_cinema/index.php?action=listRealisateurs">Liste des réalisateurs</a></li>
                            <li><a href="/appli_cinema/index.php?action=listActeurs">Liste des acteurs</a></li>                            
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="deroulant">Formulaires  <span class="material-symbols-outlined">arrow_drop_down</span></a>
                        <ul>
                            <li><a href="/appli_cinema/index.php?action=formulairePersonne">Nouveau Réalisateur/acteur</a></li>
                            <li><a href="/appli_cinema/index.php?action=formulaireFilm">Nouveau film</a></li>
                            <li><a href="/appli_cinema/index.php?action=formulaireRole">Nouveau rôle</a></li>
                            <li><a href="/appli_cinema/index.php?action=forumlaireCasting">Nouveau casting</a></li>
                        </ul>
                    </li>
            </div>
        </nav>
    </header>
    <main>

        <div id=contenu>
            <h1>PDO Cinema</h1>
            <h2><?= $titre_secondaire ?></h2>
            <!-- permet affichage d'un message lors de l'envoie du formulaire -->  
            <div id=conteneur_messages>      
                <?= getMessage();?>
            </div>
            <?= $contenu ?>
        </div>
    </main>
</body>
</html>