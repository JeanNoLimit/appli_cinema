-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- ---------------------------------------------------------- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinema_jn
CREATE DATABASE IF NOT EXISTS `cinema_jn` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `cinema_jn`;

-- Listage de la structure de la table cinema_jn. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.acteur : ~4 rows (environ)
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 2),
	(2, 3),
	(3, 4),
	(4, 6);
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) COLLATE utf8_bin NOT NULL,
  `date_sortie` date NOT NULL,
  `synopsis` text COLLATE utf8_bin,
  `duree` int(11) NOT NULL,
  `affiche` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `id_realisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `FK_film_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.film : ~2 rows (environ)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre`, `date_sortie`, `synopsis`, `duree`, `affiche`, `note`, `id_realisateur`) VALUES
	(1, 'Goldfinger', '1965-02-18', NULL, 112, NULL, NULL, 1),
	(2, 'LE SEIGNEUR DES ANNEAUX : LA COMMUNAUTÉ DE L\'ANNEAU', '2001-12-19', NULL, 178, NULL, NULL, 3);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL,
  `libelle_genre` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.genre : ~13 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `libelle_genre`) VALUES
	(1, 'Action'),
	(2, 'Aventure'),
	(3, 'Biopic'),
	(4, 'Comédie'),
	(5, 'Drame'),
	(6, 'Famille'),
	(7, 'Guerre'),
	(8, 'Historique'),
	(9, 'Policier'),
	(10, 'Romance'),
	(11, 'Science-Fiction'),
	(12, 'thriller'),
	(13, 'Western');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `id_film` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `FK_jouer_role` (`id_role`),
  KEY `FK_jouer_acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_jouer_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.jouer : ~4 rows (environ)
/*!40000 ALTER TABLE `jouer` DISABLE KEYS */;
INSERT INTO `jouer` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(2, 4, 4);
/*!40000 ALTER TABLE `jouer` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.personne : ~6 rows (environ)
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `date_naissance`, `sexe`) VALUES
	(1, 'Hamilton', 'Guy', '1922-09-11', 'M'),
	(2, 'Connery', 'Sean', '1930-08-25', 'M'),
	(3, 'Blackman', 'Honor', '1925-08-22', 'F'),
	(4, 'Fröbe', 'Gert', '1913-09-25', 'M'),
	(5, 'Jackson', 'Peter', '1961-10-31', 'M'),
	(6, 'WOOD', 'ELIJAH', '1981-01-28', 'M');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. posseder
CREATE TABLE IF NOT EXISTS `posseder` (
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK_posseder_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.posseder : ~0 rows (environ)
/*!40000 ALTER TABLE `posseder` DISABLE KEYS */;
/*!40000 ALTER TABLE `posseder` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.realisateur : ~2 rows (environ)
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(3, 5);
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_jn. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_jn.role : ~4 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'James Bond'),
	(2, 'Auric Goldfinger'),
	(3, 'Pussy Galore'),
	(4, 'Frodon Sacquet');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema_jn
CREATE DATABASE IF NOT EXISTS `cinema_jn` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema_jn`;

-- Listage de la structure de table cinema_jn. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.acteur : ~5 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 2),
	(2, 3),
	(3, 4),
	(4, 6),
	(5, 7);

-- Listage de la structure de table cinema_jn. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date_sortie` date NOT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `duree` int NOT NULL,
  `affiche` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `note` int DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `FK_film_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.film : ~7 rows (environ)
INSERT INTO `film` (`id_film`, `titre`, `date_sortie`, `synopsis`, `duree`, `affiche`, `note`, `id_realisateur`) VALUES
	(1, 'Goldfinger', '1965-02-18', NULL, 112, NULL, NULL, 1),
	(2, 'LE SEIGNEUR DES ANNEAUX : LA COMMUNAUTÉ DE L\'ANNEAU', '2001-12-19', NULL, 178, NULL, NULL, 3),
	(3, 'Gran Torino', '2009-02-25', NULL, 116, NULL, NULL, 4),
	(4, 'Le bon, la brute et le truand', '1968-03-08', NULL, 180, NULL, NULL, 5),
	(5, 'Pour les soldats tombés', '2019-07-03', NULL, 99, NULL, NULL, 3),
	(6, 'The beatles : get back', '2021-01-01', NULL, 150, NULL, NULL, 3),
	(7, 'LA Mule', '2019-01-23', NULL, 116, NULL, NULL, 4);

-- Listage de la structure de table cinema_jn. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `libelle_genre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.genre : ~15 rows (environ)
INSERT INTO `genre` (`id_genre`, `libelle_genre`) VALUES
	(1, 'Action'),
	(2, 'Aventure'),
	(3, 'Biopic'),
	(4, 'Comédie'),
	(5, 'Drame'),
	(6, 'Famille'),
	(7, 'Guerre'),
	(8, 'Historique'),
	(9, 'Policier'),
	(10, 'Romance'),
	(11, 'Science-Fiction'),
	(12, 'thriller'),
	(13, 'Western'),
	(14, 'Documentaire'),
	(15, 'fantastique');

-- Listage de la structure de table cinema_jn. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `FK_jouer_role` (`id_role`),
  KEY `FK_jouer_acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_jouer_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.jouer : ~7 rows (environ)
INSERT INTO `jouer` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(2, 4, 4),
	(4, 5, 5),
	(3, 5, 6),
	(7, 5, 7);

-- Listage de la structure de table cinema_jn. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.personne : ~8 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `date_naissance`, `sexe`) VALUES
	(1, 'Hamilton', 'Guy', '1922-09-11', 'M'),
	(2, 'Connery', 'Sean', '1930-08-25', 'M'),
	(3, 'Blackman', 'Honor', '1925-08-22', 'F'),
	(4, 'Fröbe', 'Gert', '1913-09-25', 'M'),
	(5, 'Jackson', 'Peter', '1961-10-31', 'M'),
	(6, 'WOOD', 'ELIJAH', '1981-01-28', 'M'),
	(7, 'Eastwood', 'Clint', '1930-05-31', 'M'),
	(8, 'Leone', 'Sergio', '1929-01-03', 'M');

-- Listage de la structure de table cinema_jn. posseder
CREATE TABLE IF NOT EXISTS `posseder` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK_posseder_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_posseder_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.posseder : ~11 rows (environ)
INSERT INTO `posseder` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(2, 2),
	(7, 3),
	(3, 5),
	(4, 5),
	(5, 5),
	(7, 5),
	(5, 7),
	(4, 13),
	(6, 14),
	(2, 15);

-- Listage de la structure de table cinema_jn. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.realisateur : ~5 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(3, 5),
	(6, 6),
	(4, 7),
	(5, 8);

-- Listage de la structure de table cinema_jn. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.role : ~7 rows (environ)
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'James Bond'),
	(2, 'Auric Goldfinger'),
	(3, 'Pussy Galore'),
	(4, 'Frodon Sacquet'),
	(5, 'Blondie'),
	(6, 'Walt Kowalski'),
	(7, 'Earl Stone');

-- Listage de la structure de vue cinema_jn. réals
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `réals` (
	`titre` VARCHAR(100) NOT NULL COLLATE 'utf8mb3_bin',
	`nom` VARCHAR(50) NOT NULL COLLATE 'utf8mb3_bin',
	`prenom` VARCHAR(50) NOT NULL COLLATE 'utf8mb3_bin',
	`id_personne` INT(10) NOT NULL,
	`id_realisateur` INT(10) NOT NULL,
	`anne_sortie` VARCHAR(4) NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Listage de la structure de vue cinema_jn. réals
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `réals`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `réals` AS select `f`.`titre` AS `titre`,`p`.`nom` AS `nom`,`p`.`prenom` AS `prenom`,`p`.`id_personne` AS `id_personne`,`r`.`id_realisateur` AS `id_realisateur`,date_format(`f`.`date_sortie`,'%Y') AS `anne_sortie` from ((`film` `f` join `realisateur` `r` on((`r`.`id_realisateur` = `f`.`id_realisateur`))) join `personne` `p` on((`p`.`id_personne` = `r`.`id_personne`)));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
