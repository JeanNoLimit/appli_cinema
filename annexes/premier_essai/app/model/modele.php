<?php


function connect_db(){
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=cinema_jn;charset=utf8',
            'root',
            '');
        }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        return $db;
}

// Gère l'affichage de la page d'accueil. affiche la liste complète des films avec leurs titres, nom et prénom du réalisateur, l'année de sortie et la durée des films.
function affichage_accueil(){
    $db=connect_db();
    
    $mysqlQuery='SELECT titre, nom, prenom, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
                FROM film f
                INNER JOIN realisateur r ON f.id_realisateur=r.id_realisateur
                INNER JOIN personne p ON p.id_personne=r.id_personne;';
    $filmsStatement = $db->prepare($mysqlQuery);
    $filmsStatement->execute();
    $listeFilms= $filmsStatement->fetchAll();
    return $listeFilms;
}

// Gère  l'affichage de la liste des genres.
function affichage_genres(){
    $db=connect_db();

    $mysqlQuery='SELECT libelle_genre AS genre, COUNT(id_film) AS filmParGenre
                FROM  genre g
                INNER JOIN posseder p ON g.id_genre=p.id_genre
                GROUP BY libelle_genre
                ORDER BY filmParGenre DESC;';
}
?>
