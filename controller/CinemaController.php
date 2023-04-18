<?php
// Contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues
namespace Controller;
use Model\Connect;

class CinemaController {

    // Méthode pour lister les films

    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT id_film, titre, nom, prenom, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
                                FROM film f
                                INNER JOIN realisateur r ON f.id_realisateur=r.id_realisateur
                                INNER JOIN personne p ON p.id_personne=r.id_personne;
        ');
        require "view/listFilms.php";
    }
}