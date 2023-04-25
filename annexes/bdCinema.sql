-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.acteur : ~18 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 2),
	(2, 3),
	(3, 4),
	(4, 6),
	(5, 7),
	(8, 20),
	(9, 21),
	(10, 22),
	(11, 23),
	(12, 24),
	(13, 25),
	(14, 26),
	(15, 27),
	(16, 28),
	(17, 29),
	(18, 30),
	(19, 31),
	(20, 32),
	(21, 34),
	(22, 35),
	(23, 36),
	(24, 37);

-- Listage de la structure de table cinema_jn. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date_sortie` date NOT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `duree` int NOT NULL,
  `affiche` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `note` float DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `FK_film_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.film : ~10 rows (environ)
INSERT INTO `film` (`id_film`, `titre`, `date_sortie`, `synopsis`, `duree`, `affiche`, `note`, `id_realisateur`) VALUES
	(1, 'Goldfinger', '1965-02-18', NULL, 112, NULL, NULL, 1),
	(2, 'LE SEIGNEUR DES ANNEAUX : LA COMMUNAUTÉ DE L\'ANNEAU', '2001-12-19', NULL, 178, NULL, NULL, 3),
	(3, 'Gran Torino', '2009-02-25', NULL, 116, NULL, NULL, 4),
	(4, 'Le bon, la brute et le truand', '1968-03-08', NULL, 180, NULL, NULL, 5),
	(5, 'Pour les soldats tombés', '2019-07-03', NULL, 99, NULL, NULL, 3),
	(6, 'The beatles : get back', '2021-01-01', NULL, 150, NULL, 3, 3),
	(7, 'LA Mule', '2019-01-23', NULL, 116, NULL, 4.5, 4),
	(17, 'The big Lebowski', '1998-04-22', 'Jeff Lebowski, prénommé le Duc, est un paresseux qui passe son temps à boire des coups avec son copain Walter et à jouer au bowling, jeu dont il est fanatique. Un jour deux malfrats le passent à tabac. Il semblerait qu\'un certain Jackie Treehorn veuille récupérer une somme d\'argent que lui doit la femme de Jeff. Seulement Lebowski n\'est pas marié. C\'est une méprise, le Lebowski recherché est un millionnaire de Pasadena. Le Duc part alors en quête d\'un dédommagement auprès de son richissime homonyme...', 117, '644777150e8d47.42106723.jpg', 4.1, 10),
	(18, 'True grit', '2011-02-23', '1870, juste après la guerre de Sécession, sur l&#39;ultime frontière de l&#39;Ouest américain. Seule au monde, Mattie Ross, 14 ans, réclame justice pour la mort de son père, abattu de sang-froid pour deux pièces d&#39;or par le lâche Tom Chaney. L&#39;assassin s&#39;est réfugié en territoire indien. Pour le retrouver et le faire pendre, Mattie engage Rooster Cogburn, un U.S. Marshal alcoolique. Mais Chaney est déjà recherché par LaBoeuf, un Texas Ranger qui veut le capturer contre une belle récompense. Ayant la même cible, les voilà rivaux dans la traque. Tenace et obstiné, chacun des trois protagonistes possède sa propre motivation et n&#39;obéit qu&#39;à son code d&#39;honneur. Ce trio improbable chevauche désormais vers ce qui fait l&#39;étoffe des légendes : la brutalité et la ruse, le courage et les désillusions, la persévérance et l&#39;amour...', 110, '6447941c8d7c60.61128793.jpg', 3.9, 10),
	(24, 'King Kong', '2005-12-13', 'New York, 1933. Ann Darrow est une artiste de music-hall dont la carrière a été brisée net par la Dépression. Se retrouvant sans emploi ni ressources, la jeune femme rencontre l&#39;audacieux explorateur-réalisateur Carl Denham et se laisse entraîner par lui dans la plus périlleuse des aventures...&#13;&#10;&#13;&#10;Ce dernier a dérobé à ses producteurs le négatif de son film inachevé. Il n&#39;a que quelques heures pour trouver une nouvelle star et l&#39;embarquer pour Singapour avec son scénariste, Jack Driscoll, et une équipe réduite. Objectif avoué : achever sous ces cieux lointains son génial film d&#39;action.&#13;&#10;&#13;&#10;Mais Denham nourrit en secret une autre ambition, bien plus folle : être le premier homme à explorer la mystérieuse Skull Island et à en ramener des images. Sur cette île de légende, Denham sait que &#34;quelque chose&#34; l&#39;attend, qui changera à jamais le cours de sa vie...', 180, '6447dc96615d33.43274440.jpg', 3.9, 3);

-- Listage de la structure de table cinema_jn. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL,
  `libelle_genre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

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
	(12, 'Thriller'),
	(13, 'Western'),
	(14, 'Documentaire'),
	(15, 'Fantastique');

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

-- Listage des données de la table cinema_jn.jouer : ~19 rows (environ)
INSERT INTO `jouer` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(2, 4, 4),
	(4, 5, 5),
	(3, 5, 6),
	(7, 5, 7),
	(17, 8, 15),
	(17, 9, 16),
	(17, 10, 17),
	(17, 11, 18),
	(17, 12, 19),
	(17, 13, 20),
	(17, 14, 21),
	(17, 15, 22),
	(18, 8, 23),
	(18, 16, 24),
	(18, 17, 25),
	(18, 18, 26),
	(24, 21, 40),
	(24, 22, 41),
	(24, 23, 42),
	(24, 24, 43);

-- Listage de la structure de table cinema_jn. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.personne : ~22 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `date_naissance`, `sexe`) VALUES
	(1, 'Hamilton', 'Guy', '1922-09-11', 'M'),
	(2, 'Connery', 'Sean', '1930-08-25', 'M'),
	(3, 'Blackman', 'Honor', '1925-08-22', 'F'),
	(4, 'Fröbe', 'Gert', '1913-09-25', 'M'),
	(5, 'Jackson', 'Peter', '1961-10-31', 'M'),
	(6, 'WOOD', 'ELIJAH', '1981-01-28', 'M'),
	(7, 'Eastwood', 'Clint', '1930-05-31', 'M'),
	(8, 'Leone', 'Sergio', '1929-01-03', 'M'),
	(19, 'Coen', 'Joel, Ethan', '1953-11-29', 'M'),
	(20, 'Bridges', 'Jeff', '1949-12-04', 'M'),
	(21, 'Moore', 'Julianne', '1960-12-03', 'F'),
	(22, 'Goodman', 'John', '1952-06-20', 'M'),
	(23, 'Buscemi', 'Steve', '1957-12-13', 'M'),
	(24, 'Huddleston', 'David', '1930-09-17', 'M'),
	(25, 'Hoffman', 'Philip Seymour', '1967-07-23', 'M'),
	(26, 'Reid', 'Tara', '1975-11-08', 'F'),
	(27, 'Turturro', 'John', '1957-02-28', 'M'),
	(28, 'Steinfeld', 'Hailee', '1996-12-11', 'F'),
	(29, 'Brolin', 'Josh', '1968-02-12', 'M'),
	(30, 'Damon', 'Matt', '1970-10-08', 'M'),
	(31, 'Pepper', 'Barry', '1970-04-04', 'M'),
	(32, 'Marvel', 'Elizabeth', '1969-11-27', 'F'),
	(34, 'Watts', 'Naomi', '1968-09-28', 'F'),
	(35, 'Black', 'Jack', '1969-08-28', 'M'),
	(36, 'Brody', 'Adrien', '1973-04-14', 'M'),
	(37, 'Serkis', 'Andy', '1964-04-20', 'M');

-- Listage de la structure de table cinema_jn. posseder
CREATE TABLE IF NOT EXISTS `posseder` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK_posseder_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.posseder : ~16 rows (environ)
INSERT INTO `posseder` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(2, 2),
	(18, 2),
	(24, 2),
	(7, 3),
	(17, 4),
	(3, 5),
	(4, 5),
	(5, 5),
	(7, 5),
	(18, 5),
	(5, 7),
	(17, 9),
	(4, 13),
	(18, 13),
	(6, 14),
	(2, 15),
	(24, 15);

-- Listage de la structure de table cinema_jn. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.realisateur : ~8 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(3, 5),
	(6, 6),
	(4, 7),
	(5, 8),
	(10, 19),
	(11, 23),
	(12, 27),
	(14, 37);

-- Listage de la structure de table cinema_jn. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_jn.role : ~21 rows (environ)
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'James Bond'),
	(2, 'Auric Goldfinger'),
	(3, 'Pussy Galore'),
	(4, 'Frodon Sacquet'),
	(5, 'Blondie'),
	(6, 'Walt Kowalski'),
	(7, 'Earl Stone'),
	(15, 'Jeff Lebowski &#34;The Dude&#34;'),
	(16, 'Maude Lebowski'),
	(17, 'Walter Sobchack'),
	(18, 'Donny'),
	(19, 'Jeffrey Lebowski'),
	(20, 'Brandt'),
	(21, 'Bunny Lebowski'),
	(22, 'Jesus Quintana'),
	(23, 'Rooster Cogburn'),
	(24, 'Mattie Ross'),
	(25, 'Tom Chaney'),
	(26, 'LaBoeuf'),
	(27, '&#39;Lucky&#39; Ned Pepper'),
	(28, 'Mattie Ross adulte'),
	(40, 'Ann Darrow'),
	(41, 'Carl Denham'),
	(42, 'Jack Driscoll'),
	(43, 'King Kong');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
