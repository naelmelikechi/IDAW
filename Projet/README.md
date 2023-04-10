# iMangerMieux (iMM)
Projet de site web dans le cadre de l'UV IDAW, réalisé par RUSHENAS Arnaud et MELIKECHI Nael, encadré par FABRESSE Luc et PINOT Rémy.

## Description :
Le projet iMangerMieux (iMM) consiste à réaliser une application Web permettant de maintenir un journal de tous les aliments que vous consommez. Cette application a pour but de mieux contrôler ses différents apports énergétiques. L'utilisateur de l'application est caractérisé par son login. En fonction de sa tranche d’age, de son sexe et de son niveau de pratique sportive, il est possible de calculer ses besoins énergétiques journaliers. Après avoir renseigné son profil, l’utilisateur doit pouvoir entrer les aliments qu’il consomme et en quelle quantité à une date donnée. L’historique des aliments consommés pourront être visualisés sous la forme d’un tableau. Il doit être possible de filtrer ce tableau sur une période donnée, par type d’aliment, etc. L'application permet également de calculer et afficher des indicateurs intéressants pour une période donnée, tels que la quantité de calories moyenne consommée, la quantité de sel ingérée, la quantité de sucre, le type d’aliments consommés, etc. Ces indicateurs sont à confronter avec les recommandations nutritionnelles officielles définies préalablement. 


## Architecture
L’architecture de l'application est conforme à l'architecture REST et donc découpée en 2 parties : le backend et le frontend. Le backend est écrit en PHP standard sans l'utilisation de framework ou bibliothèque externe. Le frontend utilise Bootstrap CSS, JQuery et Datatables.

### Jalon 1 : Le backend
Le backend est constitué du code PHP qui reçoit des requêtes HTTP et retourne des réponses HTTP contenant du JSON conformément à une API construite. Il est organisé dans le dossier `backend` et contient les fichiers suivants :

- `config.php` : contient des variables globales d'initialisation du backend.
- `sql/database.sql` : script SQL de création des tables avec insertion des données.
- `api.php` : contient les différents appels api en fontion des methodes (GET, DELETE, etc.)
- `functionAPI.php` : contient les fonctions utilisées par l'api
- `initPDO.php` : initialise le PDO pour se connecter à la base de données.
- `README.md` : description de l'API REST.

### Jalon 2 : Le frontend
Le frontend est constitué du code HTML, CSS et PHP qui permet d’envoyer la partie cliente de l’application au navigateur. Il est organisé dans le dossier `frontend` et contient les fichiers suivants :

- `config.php` : configuration de l'URL de l'api.
- `css` : dossier contenant les fichiers CSS pour le frontend.
- `accueil.php` : Page accueil
- `aliments.php` : Page aliments
- `dashboard.php` : Page dashboard
- `logout.php` : Page logout
- `profil.php` : Page profil
