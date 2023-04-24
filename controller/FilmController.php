<?php
// Contiendra l'ensemble des requêtes concernant les films + genres
namespace Controller;
use Model\Connect;

class FilmController {


    // Méthode pour lister les films VUE ACCUEIL

    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT id_film,f.id_realisateur, titre, nom, prenom, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
                                    FROM film f
                                    INNER JOIN realisateur r ON f.id_realisateur=r.id_realisateur
                                    INNER JOIN personne p ON p.id_personne=r.id_personne
                                    ORDER BY titre;
        ');
        require "view/listFilms.php";
    }

     //Méthodes pour lister les genres et afficher la liste des films correspondant à chaque genre. VUE PAR GENRES

     public function listGenres($id) {
        $pdo = Connect::seConnecter();
        $requete_genre = $pdo->query('SELECT g.id_genre AS id, libelle_genre, COUNT(id_film) AS filmParGenre
                                        FROM  genre g
                                        LEFT JOIN posseder p ON g.id_genre=p.id_genre
                                        GROUP BY g.id_genre
                                        ORDER BY filmParGenre DESC;'
        );
    
        $requete_liste = $pdo->prepare('SELECT f.id_film, titre, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie
                                            FROM film f
                                            INNER JOIN posseder p ON f.id_film=p.id_film
                                            INNER JOIN genre g ON p.id_genre=g.id_genre
                                            WHERE g.id_genre= :id
                                            ORDER BY titre');
        $requete_liste ->execute(["id" => $id]);
        require "view/parGenres.php";
    }

     //Méthodes pour afficher le détail des films et leurs casting VUE DETAIL FILM

     public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requete_film= $pdo->prepare('SELECT affiche, note, GROUP_CONCAT(libelle_genre SEPARATOR " / ") AS genres, f.id_film, titre, nom, prenom, f.id_realisateur, DATE_FORMAT(date_sortie, "%d/%m/%Y") AS date_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
                                        FROM film f
                                        INNER JOIN realisateur r ON f.id_realisateur=r.id_realisateur
                                        INNER JOIN personne p ON p.id_personne=r.id_personne
                                        INNER JOIN posseder po ON f.id_film=po.id_film
                                        INNER JOIN genre g ON g.id_genre=po.id_genre
                                        WHERE f.id_film = :id
                                        GROUP BY f.id_film
                        
        ');
        $requete_film ->execute(["id" => $id]);

        $requete_casting = $pdo->prepare('SELECT f.id_film, nom, prenom, nom_role, a.id_acteur, r.id_role
                                            FROM jouer j
                                            INNER JOIN film f ON j.id_film=f.id_film
                                            INNER JOIN acteur a ON j.id_acteur=a.id_acteur
                                            INNER JOIN personne p ON a.id_personne=p.id_personne
                                            INNER JOIN role r ON j.id_role=r.id_role
                                            WHERE f.id_film=:id');
        $requete_casting->execute(["id" => $id]);
        require "view/detailFilm.php";

    }
    //VUE FORMULAIRE FILM

    public function formulaireFilm(){
        $pdo = Connect::seConnecter();
        $requete_genre = $pdo->query('SELECT g.id_genre AS id, libelle_genre
                                        FROM  genre g
                                        ORDER BY libelle_genre');
        $requete_real = $pdo->query('SELECT nom, prenom, id_realisateur
                                        FROM personne p
                                        INNER JOIN realisateur r ON p.id_personne=r.id_personne
                                        ORDER BY nom, prenom;');
        require "view/formulaireFilm.php";
    }




}