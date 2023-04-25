<?php


//Gère l'affichage des messages d'alertes lors de l'envoie d'un formulaire.
function getMessage(){
    if (isset($_SESSION["messageSucces"]) && !empty($_SESSION['messageSucces'])){
        $html="<div class='containerMessages succes'><p>".$_SESSION["messageSucces"]."</p></div>";
        unset($_SESSION["messageSucces"]);
        return $html;
    
    }else if (isset($_SESSION["messageAlert"]) && !empty($_SESSION['messageAlert'])){
        $html="<div class='containerMessages alert'><p>".$_SESSION["messageAlert"]."</p></div>";
        unset($_SESSION["messageAlert"]);
        return $html;
    }
    return false;
}








?>