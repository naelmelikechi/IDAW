# iMangerMieux (iMM)
Projet de site web dans le cadre de l'UV IDAW, réalisé par RUSHENAS Arnaud et MELIKECHI Nael, encadré par FABRESSE Luc et PINOT Rémy.

## Description :
Le projet iMangerMieux (iMM) consiste à réaliser une application Web permettant de maintenir un journal de tous les aliments que vous consommez. Cette application a pour but de mieux contrôler ses différents apports énergétiques. L'utilisateur de l'application est caractérisé par son login. En fonction de sa tranche d’age, de son sexe et de son niveau de pratique sportive, il est possible de calculer ses besoins énergétiques journaliers. Après avoir renseigné son profil, l’utilisateur doit pouvoir entrer les aliments qu’il consomme et en quelle quantité à une date donnée. L’historique des aliments consommés pourront être visualisés sous la forme d’un tableau. Il doit être possible de filtrer ce tableau sur une période donnée, par type d’aliment, etc. L'application permet également de calculer et afficher des indicateurs intéressants pour une période donnée, tels que la quantité de calories moyenne consommée, la quantité de sel ingérée, la quantité de sucre, le type d’aliments consommés, etc. Ces indicateurs sont à confronter avec les recommandations nutritionnelles officielles définies préalablement. 


## Architecture
L’architecture de l'application est conforme à l'architecture REST et donc découpée en 2 parties : le backend et le frontend. Le backend est écrit en PHP standard sans l'utilisation de framework ou bibliothèque externe. Le frontend utilise Bootstrap CSS, JQuery et Datatables.

### Le backend
Le backend est constitué du code PHP qui reçoit des requêtes HTTP et retourne des réponses HTTP contenant du JSON conformément à une API construite. Il est organisé dans le dossier `backend` et contient les fichiers suivants :

- `config.php` : contient des variables globales d'initialisation du backend.
- `sql/database.sql` : script SQL de création des tables avec insertion des données.
- `api.php` : contient les différents appels api en fontion des methodes (GET, DELETE, etc.)
- `functionAPI.php` : contient les fonctions utilisées par l'api
- `initPDO.php` : initialise le PDO pour se connecter à la base de données.
- `README.md` : description de l'API REST.

## API ENPPOINTS

### Utilisateurs
- `GET /utilisateurs` - Obtenir tous les utilisateurs
- `GET /utilisateurs?id=<id>` - Obtenir un utilisateur spécifique par ID
- `POST /utilisateurs` - Créer un nouvel utilisateur
- `PUT /utilisateurs?id=<id>` - Mettre à jour un utilisateur par ID
- `DELETE /utilisateurs?id=<id>` - Supprimer un utilisateur par ID

### Aliments
- `GET /aliments - Obtenir tous les aliments`
- `GET /aliments?id=<id>` - Obtenir un aliment spécifique par ID
- `POST /aliments` - Créer un nouvel aliment
- `PUT /aliments?id=<id>` - Mettre à jour un aliment par ID
- `DELETE /aliments?id=<id>` - Supprimer un aliment par ID

### Consommations
- `GET /consommations` - Obtenir toutes les consommations d'aliments
- `GET /consommations?id=<id>` - Obtenir une consommation spécifique par ID
- `GET /consommation/userspecifique?id=<user_id>` - Obtenir les consommations d'aliments pour un utilisateur spécifique par ID utilisateur
- `GET /consommation/id_date?id=<user_id>&date=<date>` - Obtenir la consommation d'aliments pour un utilisateur spécifique par ID utilisateur et date
- `GET /consommations/calories?id=<user_id>&date=<date>` - Obtenir le total des calories consommées par un utilisateur à une date spécifique
- `POST /consommations` - Créer une nouvelle consommation d'aliments
- `PUT /consommations?id=<id>` - Mettre à jour une consommation d'aliments par ID
- `DELETE /consommations?id=<id>` - Supprimer une consommation d'aliments par ID

### Recommandations de calories
- `GET /recommandations/calories?id=<user_id>` - Obtenir la recommandation de calories pour un utilisateur par ID utilisateur

### Connexion
- `GET /login?email=<email>&password=<password>` - Authentifier un utilisateur avec son adresse e-mail et son mot de passe