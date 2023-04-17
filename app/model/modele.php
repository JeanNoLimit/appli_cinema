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

?>
