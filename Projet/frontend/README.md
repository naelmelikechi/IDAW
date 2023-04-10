# iMangerMieux (iMM)
Projet de site web dans le cadre de l'UV IDAW, réalisé par RUSHENAS Arnaud et MELIKECHI Nael, encadré par FABRESSE Luc et PINOT Rémy.

## Description :
Le projet iMangerMieux (iMM) consiste à réaliser une application Web permettant de maintenir un journal de tous les aliments que vous consommez. Cette application a pour but de mieux contrôler ses différents apports énergétiques. L'utilisateur de l'application est caractérisé par son login. En fonction de sa tranche d’age, de son sexe et de son niveau de pratique sportive, il est possible de calculer ses besoins énergétiques journaliers. Après avoir renseigné son profil, l’utilisateur doit pouvoir entrer les aliments qu’il consomme et en quelle quantité à une date donnée. L’historique des aliments consommés pourront être visualisés sous la forme d’un tableau. Il doit être possible de filtrer ce tableau sur une période donnée, par type d’aliment, etc. L'application permet également de calculer et afficher des indicateurs intéressants pour une période donnée, tels que la quantité de calories moyenne consommée, la quantité de sel ingérée, la quantité de sucre, le type d’aliments consommés, etc. Ces indicateurs sont à confronter avec les recommandations nutritionnelles officielles définies préalablement. 


## Utilisation

Pour utiliser cette plateforme, nous avons créé un utilisateur dont voici les informations de connexion :

- Adresse email : `luc.fabresse@imt-nord-europe.fr`
- Mot de passe : `zH9sM3nC1vTq`

## Le frontend
Le frontend est constitué du code HTML, CSS et PHP qui permet d’envoyer la partie cliente de l’application au navigateur. Il est organisé dans le dossier `frontend` et contient les fichiers suivants :

- `config.php` : configuration de l'URL de l'api.
- `css` : dossier contenant les fichiers CSS pour le frontend.
- `accueil.php` : Page accueil
- `aliments.php` : Page aliments
- `dashboard.php` : Page dashboard
- `logout.php` : Page logout
- `profil.php` : Page profil
- `README.md` : description de la partie front
- A noter que la partie login est dans le fichier index.php directement dans la racine du projet pour que l'utilisateur arrive directement sur la page de login.
