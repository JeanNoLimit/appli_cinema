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
                                    ORDER BY anne_sortie DESC;
        ');
        require "view/listFilms.php";
    }

    
    //Méthodes pour afficher le détail des films et leurs casting VUE DETAIL FILM
        public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requete_film= $pdo->prepare('SELECT affiche, note, synopsis, GROUP_CONCAT(libelle_genre SEPARATOR " , ") AS genres, f.id_film, titre, nom, prenom, f.id_realisateur, DATE_FORMAT(date_sortie, "%d/%m/%Y") AS date_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
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
                                           ORDER BY anne_sortie DESC;');
       $requete_liste ->execute(["id" => $id]);
       require "view/parGenres.php";
   }




    //*********VUE FORMULAIRE FILM*********//

    public function formulaireFilm(){
        $pdo = Connect::seConnecter();
        // On aura besoin d'uploader une image. Pour ce faire suivre le tuto : https://espritweb.fr/comment-uploader-une-image-en-php/
        $requete_genre = $pdo->query('SELECT g.id_genre AS id, libelle_genre
                                        FROM  genre g
                                        ORDER BY libelle_genre');
        $requete_real = $pdo->query('SELECT nom, prenom, id_realisateur
                                        FROM personne p
                                        INNER JOIN realisateur r ON p.id_personne=r.id_personne
                                        ORDER BY nom, prenom;');

        if(isset($_POST['submitFilm'])){
           
            $titre=filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
            // On obtient un tableau qui contient les id_genres
            $id_genres=filter_input(INPUT_POST, "id_genres", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $date_sortie=filter_input(INPUT_POST, "date_sortie", FILTER_SANITIZE_SPECIAL_CHARS);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_INT );
            $id_realisateur=filter_input(INPUT_POST, "id_realisateur", FILTER_VALIDATE_INT );
            // Si une note a été rentré dans le formulaire alors il faut filtrer le résultat, sinon renvoyer "null"
            
            if(isset($_POST['note']) && !empty($_POST['note'])){
                $note=filter_input(INPUT_POST,"note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //FILTER_FLAG_FRACTION est ajouté pour permettre l'utilisation du caractère , ou . pour la décimale
            }else{
                $note=null;
            }

            // On récupère les données de l'image
            if(isset($_FILES['affiche'])){
                $tmpName = $_FILES['affiche']['tmp_name'];
                $name = $_FILES['affiche']['name'];
                $size = $_FILES['affiche']['size'];
                $error = $_FILES['affiche']['error'];
            }
            // ***********VERIFICATIONS FICHIER IMAGE*********************//
            //On va vérifier l'extension du fichier pour n'accepter que les images
            //      1. On découpe le nom du fichier au niveau du point . -> Renvoie le résultat dans un tableau $tabExtension
            //      2. On récupère le dernier élément du tableau. strtolower permet de mettre en minuscule la chaine de caractère
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            // On liste les extensions autorisé
            $extensions= ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte (en bytes) 1Mo;
            $tMax= 1048576;


            if(in_array($extension, $extensions) && $size<=$tMax && $error==0) {

                // uniqid() est une fonction qui permet de générer un nom unique. 2 arguments : La chaine de caractère qui sert de préfixe et un booléen pour augmenter la taille de chaîne pour + de sécurité
                $uniqueName =uniqid('', true);
                $file=$uniqueName.".".$extension;

                // Fonction qui permet de déplacer le fichier dans le bon dossier. https://www.php.net/manual/fr/function.move-uploaded-file.php
                move_uploaded_file($tmpName, './upload/'. $file);
            }else {
                echo "Mauvaise extension ou image trop importante";
            }


            // Si les filtres ont renvoyé un résultat dans les variables....
            if($titre && $id_genres && $date_sortie && $duree && $id_realisateur){
               
                $pdo= Connect::seConnecter();
                // Requête pour insérer les données dans la table film
                $requete_film = $pdo ->prepare('INSERT INTO film(titre, date_sortie, duree, note, id_realisateur, affiche)
                                                     VALUES (:titre, :date_sortie, :duree, :note, :id_realisateur, :affiche)');
                $requete_film->execute(['titre' => $titre, 'date_sortie' => $date_sortie, 'duree' => $duree, 'note' => $note,'id_realisateur' => $id_realisateur, 'affiche' => $file]);

                // On récupère l'identifiant du film créée
                $film_id = $pdo->lastInsertId();

                // Requête pour insérer les données dans la table posséder qui lie la table genre à film
                foreach($id_genres as $genre){
                    $req_genre =$pdo -> prepare('INSERT INTO posseder (id_genre, id_film)
                                                    VALUES ( :id_genre, :id_film) ');
                    $req_genre ->execute (['id_genre'=> $genre, 'id_film' => $film_id]);

                }
            }    
        }
        require "view/formulaireFilm.php";
    }




}