# Projet-BDD-IMDB
* Projet [INFOH303 Base de donnée](http://cs.ulb.ac.be/public/teaching/infoh303) ayant obtenu une note de 20/20.
* Développeurs Jacobs Alexandre, Engelman Benjamin et Engelman David.
* Copyright ULB-2016-2017.


# Enoncé du projet
* [Enoncé](H303-Enonce-Projet.pdf)


# Creation db
1) Télecharger les fichiers imdb avec le script [download_file_unzip.sh](./scripts_database/download_file_unzip.sh)
2) parse les ficher avec [parseAll.sh](./Parsing/parseAll.sh)
3) Run le script [fill.sh](./scripts_database/fill.sh)

# Lancement site web

* Se rendre dans le dossier ./site_web/ à l'aide d'un terminal et y lancer la commande suivante: php -S localhost:8000. Pour accèder à la page d'acceuille, ouvrir un navigateur web et aller sur localhost:8000/welcome_page.php .

# Outils nécessaire.

* PHP
* MySql-Server
* Apache2
* Pour de plus amples informations voir la documentation ubuntu pour [LAMP](https://doc.ubuntu-fr.org/lamp).
