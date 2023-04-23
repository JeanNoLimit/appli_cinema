<?php
// Contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues
namespace Controller;
use Model\Connect;

class CinemaController {



    // Méthode pour lister les films

    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT id_film,f.id_realisateur, titre, nom, prenom, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
                                    FROM film f
                                    INNER JOIN realisateur r ON f.id_realisateur=r.id_realisateur
                                    INNER JOIN personne p ON p.id_personne=r.id_personne;
        ');
        require "view/listFilms.php";
    }

    //Méthode pour lister les acteurs

    public function listActeurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT nom, prenom, a.id_acteur
                                    FROM personne p
                                    INNER JOIN acteur a ON p.id_personne=a.id_personne
                                    ORDER BY nom, prenom;
        ');
        require "view/listActeurs.php";
    }
    //Méthode pour lister les réalisateurs

    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT nom, prenom, id_realisateur
                                    FROM personne p
                                    INNER JOIN realisateur r ON p.id_personne=r.id_personne
                                    ORDER BY nom, prenom;'        
        );
        require "view/listRealisateurs.php";
    }

    //Méthodes pour lister les genres et afficher la liste des films correspondant à chaque genre.

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
                                            WHERE g.id_genre= :id');
        $requete_liste ->execute(["id" => $id]);
        require "view/parGenres.php";
    }

    //Méthodes pour afficher le détail des films et leurs casting

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

    //Méthodes pour afficher les informations détaillées d'un réalisateur et ainsi que sa filmographie

    public function detailReal($id) {
        $pdo = Connect::seConnecter();
        $requete_infoReal = $pdo->prepare ('SELECT p.id_personne, id_realisateur, nom, prenom, sexe, DATE_FORMAT(date_naissance, "%d/%m/%Y") AS date_Nais
                                                FROM personne p
                                                INNER JOIN realisateur r ON r.id_personne=p.id_personne
                                                WHERE id_realisateur= :id');
        $requete_infoReal ->execute(["id" => $id]);
                    //Concaténation des genres en une chaîne de caractères afin de les afficher tous si un film en contient plusieurs. https://sql.sh/fonctions/group_concat
        $requete_filmoReal = $pdo->prepare ('SELECT f.id_film, f.id_realisateur, titre, DATE_FORMAT(date_sortie, "%Y") AS annee_sortie, GROUP_CONCAT(libelle_genre) AS genres, note
                                                FROM film f
                                                INNER JOIN realisateur r ON r.id_realisateur=f.id_realisateur
                                                INNER JOIN personne p ON p.id_personne=r.id_personne
                                                INNER JOIN posseder po ON f.id_film=po.id_film
                                                INNER JOIN genre g ON g.id_genre=po.id_genre
                                                WHERE r.id_realisateur=:id
                                                GROUP BY f.id_film');
        $requete_filmoReal->execute(["id" => $id]);
        require "view/detailReal.php";

    }
    //Méthodes pour afficher les informations d'un acteur ainsi que sa filmographie
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requete_infoActeur = $pdo->prepare ('SELECT p.id_personne, id_acteur, nom, prenom, sexe, DATE_FORMAT(date_naissance, "%d/%m/%Y") AS date_Nais
                                                FROM personne p
                                                INNER JOIN acteur a ON p.id_personne=a.id_personne
                                                WHERE a.id_acteur= :id');
        $requete_infoActeur -> execute(["id" => $id]);

        $requete_filmoActeur = $pdo->prepare ('SELECT f.id_film,f.titre,nom, prenom,r.id_role, nom_role, DATE_FORMAT(date_sortie, "%Y") AS annee_sortie, note
                                                FROM jouer j
                                                INNER JOIN film f ON j.id_film=f.id_film
                                                INNER JOIN acteur a ON j.id_acteur=a.id_acteur
                                                INNER JOIN personne p ON a.id_personne=p.id_personne
                                                INNER JOIN role r ON j.id_role=r.id_role
                                                WHERE a.id_acteur= :id
                                                ORDER BY annee_sortie DESC;');
        $requete_filmoActeur -> execute(["id" => $id]);
        require "view/detailActeur.php";
    }
    // Méthodes pour afficher le détail d'un rôle, la liste des films où le personnage apparait et la liste des acteurs qui l'ont interprété
    public function detailRole($id) {
        $pdo = Connect::seConnecter();
        $requete_infoRole = $pdo->prepare ('SELECT nom_role, id_role
                                            FROM role
                                            WHERE id_role= :id');
        $requete_infoRole-> execute(["id" => $id]);
        

        $requete_listRole = $pdo->prepare ('SELECT f.id_film, a.id_acteur, titre, DATE_FORMAT(date_sortie, "%Y") AS annee_sortie, prenom, nom
                                            FROM role r
                                            INNER JOIN jouer j ON r.id_role=j.id_role
                                            INNER JOIN acteur a ON j.id_acteur=a.id_acteur
                                            INNER JOIN personne p ON p.id_personne=a.id_personne
                                            INNER JOIN film f ON j.id_film=f.id_film
                                            WHERE r.id_role= :id 
                                            ORDER BY annee_sortie DESC;');
        $requete_listRole -> execute(["id" => $id]);
        require "view/detailRole.php";
    }
// VUES FORMULAIRES

    public function formulairePersonne(){
        require "view/formulairePersonne.php";
    }

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
    
    public function formulaireRole(){
        require "view/formulaireRole.php";
    }

    public function formulaireCasting(){
        // On récupère la liste des films
        $pdo = Connect::seConnecter();
        $requete_film = $pdo->query('SELECT id_film, titre
                                        FROM film f');
    
        //On récupère la liste des rôles
        $requete_role = $pdo->query('SELECT nom_role, id_role
                                        FROM role');

        //On récupère la liste des acteurs
        $requete_acteur = $pdo->query('SELECT id_acteur, nom, prenom
                                        FROM personne p
                                        INNER JOIN acteur a ON p.id_personne=a.id_personne');
                                        
        require "view/formulaireCasting.php";

    }
}