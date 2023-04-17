<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
    <title><?=$title?></title>
</head>
<body>
    <header>
        <nav>
            <div id="wrap">
                <ul class="navbar">
                    <li>
                        <a href="app/view/acceuil.php">Acceuil</a>
                    </li>
                    <li>
                        <a href="#" class="deroulant">Filtrer affichages  <span class="material-symbols-outlined">arrow_drop_down</span></a>
                        <ul>
                            <li><a href="#">Par genres</a></li>
                            <li><a href="#">Par réalisateurs</a></li>
                            <li><a href="#">Par acteurs</a></li>
                            <li><a href="#">Par rôle</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="deroulant">Formulaires  <span class="material-symbols-outlined">arrow_drop_down</span></a>
                        <ul>
                            <li><a href="#">Nouveau Réalisateur/acteur</a></li>
                            <li><a href="#">Nouveau film</a></li>
                            <li><a href="#">Nouveau rôle</a></li>
                            <li><a href="#">Nouveau casting</a></li>
                        </ul>
                    </li>
            </div>
        </nav>
    </header>

    <?= $content ?>

</body>
</html>