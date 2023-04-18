<?php
// <!-- ICI, on se contente de déclarer la connexion à la base de données -->
// Namespace permet de catégoriser virutellement (dans un espace de nom la classe en question).
// On pourra "use" la classe sans connaître son emplacement physique.
//  On a juste besoin de savoir dans quel namespace elle se trouve.
namespace Model;
// Class abstraite car on ne l'instanciera jamais, on veut juste accéder à sa méthode "seConnecter"
abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema_jn";
    const USER = "root";
    const PASS = "";

    public static function seConnecter(){
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch(\PDOException $ex) {
            return $ex->getMessage();
        }
    }
}

