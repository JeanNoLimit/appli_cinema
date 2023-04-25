<?php
// Contiendra l'ensemble des requêtes concernant les Réalisateur/acteurs
namespace Controller;
use Model\Connect;

class PersonneController {

     //Méthode pour lister les acteurs

     public function listActeurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT nom, prenom, a.id_acteur
                                    FROM personne p
                                    INNER JOIN acteur a ON p.id_personne=a.id_personne
                                    INNER JOIN jouer j ON a.id_acteur=j.id_acteur
                                    GROUP BY a.id_acteur
                                    ORDER BY nom, prenom;');
        require "view/listActeurs.php";
    }
    //Méthode pour lister les réalisateurs

    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query('SELECT nom, prenom, r.id_realisateur
                                    FROM personne p
                                    INNER JOIN realisateur r ON p.id_personne=r.id_personne
                                    INNER JOIN film f ON f.id_realisateur=r.id_realisateur
                                    GROUP BY r.id_realisateur
                                    ORDER BY nom, prenom');
        require "view/listRealisateurs.php";
    }

     //Méthodes pour afficher les informations détaillées d'un réalisateur et ainsi que sa filmographie VUE DETAILREALISATEUR

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
    //Méthodes pour afficher les informations d'un acteur ainsi que sa filmographie VUE DETAILACTEUR
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

    // VUES FORMULAIRE PERSONNE -> REALISATEUR/ACTEUR


    public function formulairePersonne(){

            if(isset($_POST['submitPers'])){
                
                // var_dump($_POST);die;

                $nom = filter_input(INPUT_POST,"nom",FILTER_SANITIZE_SPECIAL_CHARS );
                $prenom = filter_input(INPUT_POST,"prenom",FILTER_SANITIZE_SPECIAL_CHARS );
                $date_naissance = filter_input(INPUT_POST,"date_naissance",FILTER_SANITIZE_SPECIAL_CHARS);
                $sexe = filter_input(INPUT_POST,"sexe",FILTER_SANITIZE_SPECIAL_CHARS );
                $metier = filter_input(INPUT_POST, "metier", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                if($nom && $prenom && $date_naissance && $sexe && $metier){
                

                    $pdo = Connect::seConnecter();

                    $requete=$pdo ->prepare('INSERT INTO personne (nom, prenom, date_naissance, sexe)
                                                VALUES (:nom, :prenom, :date_naissance, :sexe)');
                    $requete->execute(['nom' => $nom, 'prenom' => $prenom, 'date_naissance' => $date_naissance, 'sexe' => $sexe]);
                    
                    // La fonction lastInsertId va récupérer l'id de la personne et l'insérer dans la table réalisateur et/ou acteur. https://www.php.net/manual/fr/pdo.lastinsertid.php
                    $personne_id = $pdo->lastInsertId();
                    //On parcourt le tableau $métier pour ajouter la personne à réalisateur ou acteur
                    foreach($metier as $value){
                        if($value=='realisateur'){
                            $requeteReal =$pdo ->prepare('INSERT INTO realisateur (id_personne)
                                                        VALUES( :id_personne)');
                            $requeteReal->execute(['id_personne' => $personne_id]);
                        }elseif ($value=='acteur'){
                            $requeteActeur =$pdo ->prepare('INSERT INTO acteur (id_personne)
                                                    VALUES( :id_personne)');
                            $requeteActeur->execute(['id_personne' => $personne_id]);
                        }
                    }
                }
            }


    
        require "view/formulairePersonne.php";
    }





}

?>