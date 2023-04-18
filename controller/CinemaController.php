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

    //Méthode pour lister les acteurs

    public function listActeurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT nom, prenom
                                FROM personne p
                                INNER JOIN acteur a ON p.id_personne=a.id_personne
                                ORDER BY nom, prenom;
        ');
        require "view/listActeurs.php";
    }
    //Méthode pour lister les réalisateurs

    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT nom, prenom
                                FROM personne p
                                INNER JOIN realisateur r ON p.id_personne=r.id_personne
                                ORDER BY nom, prenom;'        
        );
        require "view/listRealisateurs.php";
    }

    //Méthode pour lister les genres

        public function listGenres() {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('SELECT libelle_genre AS genre, COUNT(id_film) AS filmParGenre
                                    FROM  genre g
                                    LEFT JOIN posseder p ON g.id_genre=p.id_genre
                                    GROUP BY libelle_genre
                                    ORDER BY filmParGenre DESC;'
            );
            require "view/parGenres.php";
        }
    
}