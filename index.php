<!-- Va accueillir l'action transmise par l'URL (en GET)  -->
<!-- URL sera sous le forme index.php?action=listFilms -->

<?php

// On "use" les contrôleurs cinema. Permet d'importer les controllers
// https://www.php.net/manual/fr/language.namespaces.importing.php
use Controller\CinemaController;
use Controller\FilmController;
use Controller\PersonneController;
use Controller\CastingController;

//On autocharge les classes du projet
spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

// On instancie les controllers Cinema (qui contiennent l'ensemble des requêtes dans les fonctions en relation avec les vues)
$ctrlFilm = new FilmController();
$ctrlPers = new PersonneController();
$ctrlCasting = new CastingController();


$id=(isset($_GET["id"])) ? $_GET["id"] : null;
//Pour affichage de la page d'accueil avant toute action
if(!isset($_GET["action"])){
    $ctrlFilm->listFilms();
}
// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
// (Pour rappel :isset — Détermine si une variable est déclarée et est différente de null)
elseif(isset($_GET["action"])){
    switch($_GET["action"]) {
        case "listFilms" : $ctrlFilm->listFilms(); break;
        case "listActeurs" : $ctrlPers->listActeurs(); break;
        case "listRealisateurs" : $ctrlPers->listRealisateurs(); break;
        case "listGenres" : $ctrlFilm->listGenres($id); break; //affichage de la page "par genre"
        case "detailFilm" : $ctrlFilm->detailFilm($id); break;
        case "detailReal" : $ctrlPers->detailReal($id); break;
        case "detailActeur" : $ctrlPers->detailActeur($id); break;
        case "detailRole" : $ctrlcasting->detailRole($id); break;    
        case "formulaireFilm" : $ctrlFilm->formulaireFilm(); break;
        case "formulaireRole" : $ctrlCasting->formulaireRole();break;
        case "forumlaireCasting" : $ctrlCasting->formulaireCasting();break;
        case "ajoutPersonne" : $ctrlPers->formulairePersonne(); break;
    }
}