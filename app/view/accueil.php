<?php
session_start();
ob_start();
require_once "../model/modele.php";


// <!-- insérer tableau avec la liste complète des films -->

echo "<main>
        <div class=container>",
            "<table class='tableFilm'>",
                "<thread>",
                    "<tr>",
                        "<th>Titre</th>",
                        "<th>Réalisateur</th>",
                        "<th>Année de sortie</th>",
                        "<th>Durée</th>",
                    "</tr>",
                "</thread>",
                "<tbody>";
$listeFilms=affichage_accueil();
foreach($listeFilms as $film){
    echo "<tr>",
            "<td>".$film['titre']."</td>",
            "<td>".$film['nom']." ". $film['prenom']."</td>",
            "<td>".$film['anne_sortie']."</td>",
            "<td>".$film['duree']."</td>",
        "</tr>";
}
echo            "</tbody>",
            "</table>",
        "</div>",
    "</main>";


$content=ob_get_clean();
$title="Acceuil";
require "../../www/index.php";

?>