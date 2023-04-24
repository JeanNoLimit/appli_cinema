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
        // Si la variable $_POST exsite
        if(isset($_POST['submitRole'])){
            // On filtre la varialbe nom_role pour remplacer les caractères spéciaux (p.e. < ou >) en entités HTML pour éviter l'insersion de code 
            $nom_role = filter_input(INPUT_POST,"nom_role",FILTER_SANITIZE_SPECIAL_CHARS );
            //Si "nom_role" a passé le test et que la variable $nom_role renvoie un résultat :
            if($nom_role){
                //Connection à la bd.
                $pdo = Connect::seConnecter();
                //Préparer la requête permet de prévenir les attaques par injection SQL en éliminant le besoin de protéger les paramètres manuellement.https://www.php.net/manual/fr/pdo.prepare.php
                $req = $pdo ->prepare("INSERT INTO role (nom_role)
                                        VALUES (:nom_role)");
                // les "doubles-points" : signifient qu'on appelle une variable hôte (variable du language hôte -> php)
                $req->execute(["nom_role" => $nom_role]);


                
            }

        }
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
                                        FROM role
                                        ORDER BY nom_role');

        //On récupère la liste des acteurs
        $requete_acteur = $pdo->query('SELECT id_acteur, nom, prenom
                                        FROM personne p
                                        INNER JOIN acteur a ON p.id_personne=a.id_personne
                                        ORDER BY nom');

        //Gestion de l'envoie du formulaire
        if(isset($_POST['submitCasting'])){
            
            $id_film=filter_input(INPUT_POST, "id_film", FILTER_VALIDATE_INT );
            $id_acteur=filter_input(INPUT_POST, "id_acteur", FILTER_VALIDATE_INT );
            $id_role=filter_input(INPUT_POST, "id_role", FILTER_VALIDATE_INT );

        if($id_film && $id_acteur && $id_role){
                $pdo= Connect::seConnecter();
            $requete_casting= $pdo->prepare('INSERT INTO jouer (id_film, id_acteur, id_role)
                                                VALUES( :id_film, :id_acteur, :id_role)');
            $requete_casting->execute(['id_film'=>$id_film, 'id_acteur'=>$id_acteur, 'id_role'=>$id_role]);
        }
        }




                                        
        require "view/formulaireCasting.php";

    }

}