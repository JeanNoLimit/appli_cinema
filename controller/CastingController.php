<?php
// Contiendra l'ensemble des requêtes concernant les Castings + rôles
namespace Controller;
use Model\Connect;



class CastingController {

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
    //VUES FORMULAIRES
        //Formulaire rôle
    public function formulaireRole(){
        require "view/formulaireRole.php";
    }
        //FORMULAIRE CASTING
    public function formulaireCasting(){
        // On récupère la liste des films
        $pdo = Connect::seConnecter();
        $requete_film = $pdo->query('SELECT id_film, titre
                                        FROM film f
                                        ORDER BY titre');
    
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