-- a.	Informations d’un film(id_film): titre, année, durée (au format HH:MM) et réalisateur.
SELECT id_film, titre, Nom AS nom_Real, prenom, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie, TIME_FORMAT(SEC_TO_TIME(duree*60),"%H h %i") AS duree
FROM film f
INNER JOIN realisateur r ON f.id_realisateur=r.id_realisateur
INNER JOIN personne p ON p.id_personne=r.id_personne;

-- b.	Liste des films dont la durée excède 2h15 classés par durée (du plus long au plus court).
SELECT titre, duree AS duree_minutes
FROM film
WHERE duree>135
ORDER BY duree DESC;

-- c.	Liste des films d’un réalisateur (en précisant l’année de sortie)
SELECT titre, nom, prenom, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie
FROM film f
INNER JOIN realisateur r ON r.id_realisateur=f.id_realisateur
INNER JOIN personne p ON p.id_personne=r.id_personne
WHERE r.id_realisateur=1;


-- d.	Nombre de films par genre (classés dans l’ordre décroissant)

SELECT libelle_genre AS genre, COUNT(id_film) AS filmParGenre
FROM  genre g
INNER JOIN posseder p ON g.id_genre=p.id_genre
GROUP BY libelle_genre
ORDER BY filmParGenre DESC;

-- e.	 Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT nom, prenom, COUNT(id_film) AS nbFilm
FROM realisateur r
INNER JOIN personne p ON r.id_personne=p.id_personne
INNER JOIN film f ON r.id_realisateur=f.id_realisateur
GROUP BY nom, prenom
ORDER BY nbFilm DESC;

-- f.	Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe

SELECT titre,nom, prenom, sexe
FROM jouer j
INNER JOIN film f ON j.id_film=f.id_film
INNER JOIN acteur a ON j.id_acteur=a.id_acteur
INNER JOIN personne p ON a.id_personne=p.id_personne
WHERE f.id_film=1;


-- g.	Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)

SELECT f.titre,nom, prenom, nom_role, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie
FROM jouer j
INNER JOIN film f ON j.id_film=f.id_film
INNER JOIN acteur a ON j.id_acteur=a.id_acteur
INNER JOIN personne p ON a.id_personne=p.id_personne
INNER JOIN role r ON j.id_role=r.id_role
WHERE a.id_acteur=1
ORDER BY anne_sortie DESC;

-- h.	Listes des personnes qui sont à la fois acteurs et réalisateurs

SELECT nom, prenom
FROM personne p
INNER JOIN acteur a ON p.id_personne=a.id_personne
INNER JOIN realisateur r ON p.id_personne=r.id_personne
INNER JOIN film f ON r.id_realisateur=f.id_realisateur
INNER JOIN jouer j ON j.id_acteur=a.id_acteur;

-- i.	Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)

SELECT titre, DATE_FORMAT(date_sortie, "%Y") AS anne_sortie
FROM film
WHERE CAST(YEAR(NOW())-YEAR(date_sortie) AS SIGNED INTEGER)<5

-- j.	Nombre d’hommes et de femmes parmi les acteurs

SELECT COUNT(sexe) AS sexe
FROM acteur a
INNER JOIN personne p ON a.id_personne=p.id_personne
WHERE sexe='M'  
UNION
SELECT COUNT(sexe)
FROM acteur a
INNER JOIN personne p ON a.id_personne=p.id_personne
WHERE sexe='F'

-- k.	Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)

SELECT nom, prenom
FROM acteur a
INNER JOIN personne p ON a.id_personne=p.id_personne
WHERE CAST(YEAR(NOW())-YEAR(p.date_naissance) AS SIGNED INTEGER)>50


-- l.	Acteurs ayant joué dans 3 films ou plus

SELECT nom, prenom, COUNT(j.id_film) AS nbFilm
FROM acteur a
INNER JOIN personne p ON a.id_personne=p.id_personne
INNER JOIN jouer j ON a.id_acteur=j.id_acteur
GROUP BY nom, prenom
HAVING COUNT(j.id_film)>=3
