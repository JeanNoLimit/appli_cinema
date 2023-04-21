<!-- Va accueillir l'action transmise par l'URL (en GET)  -->
<!-- URL sera sous le forme index.php?action=listFilms -->

<?php

// On "use" le contrôleur cinema. Permet d'inporter le controller
// https://www.php.net/manual/fr/language.namespaces.importing.php
use Controller\CinemaController;

//On autocharge les classes du projet
spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

// On instancie le controller Cinema (qui contient l'ensemble des requêtes dans les fonctions en relation avec les vues)
$ctrlCinema = new CinemaController();


$id=(isset($_GET["id"])) ? $_GET["id"] : null;
//Pour affichage de la page d'accueil avant toute action
if(!isset($_GET["action"])){
    $ctrlCinema->listFilms();
}
// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
// (Pour rappel :isset — Détermine si une variable est déclarée et est différente de null)
elseif(isset($_GET["action"])){
    switch($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "listGenres" : $ctrlCinema->listGenres($id); break; //affichage de la page "par genre"
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        case "detailReal" : $ctrlCinema->detailReal($id); break;
        case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        case "detailRole" : $ctrlCinema->detailRole($id); break;
    }
}