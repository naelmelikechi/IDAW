# Projet IDAW : iMangerMieux (iMM)
## Description :
Le projet iMangerMieux (iMM) consiste à réaliser une application Web permettant de maintenir un journal de tous les aliments que vous consommez. Cette application a pour but de mieux contrôler ses différents apports énergétiques. L'utilisateur de l'application est caractérisé par son login. En fonction de sa tranche d’age, de son sexe et de son niveau de pratique sportive, il est possible de calculer ses besoins énergétiques journaliers. Après avoir renseigné son profil, l’utilisateur doit pouvoir entrer les aliments qu’il consomme et en quelle quantité à une date donnée. L’historique des aliments consommés pourront être visualisés sous la forme d’un tableau. Il doit être possible de filtrer ce tableau sur une période donnée, par type d’aliment, etc. L'application permet également de calculer et afficher des indicateurs intéressants pour une période donnée, tels que la quantité de calories moyenne consommée, la quantité de sel ingérée, la quantité de sucre, le type d’aliments consommés, etc. Ces indicateurs sont à confronter avec les recommandations nutritionnelles officielles.

## Fonctionnalités:
- Affichage d’un tableau CRUD affichant une liste d’aliments
- Aliments stockés en base dans une table aliment
- Formulaire permettant d’ajouter et éditer les aliments
- Affichage d'un dashboard présentant les indicateurs choisis pour l'utilisateur
- Page profil permettant de renseigner les informations de l'utilisateur
- Page aliments affichant les aliments de la base avec la possibilité d’en ajouter, d’en supprimer, de les modifier, etc.
- Page journal affichant son journal avec possibilité d’ajouter une entrée

## Architecture
L’architecture de l'application est conforme à l'architecture REST et donc découpée en 2 parties : le backend et le frontend. Le backend est écrit en PHP standard sans l'utilisation de framework ou bibliothèque externe. Le frontend utilise Bootstrap CSS, JQuery et Datatables.

### Jalon 1 : Le backend
Le backend est constitué du code PHP qui reçoit des requêtes HTTP et retourne des réponses HTTP contenant du JSON conformément à une API construite. Il est organisé dans le dossier `backend` et contient les fichiers suivants :

`sql/database.sql` : script SQL de création des tables avec insertion des données
`config.php` : contient des variables globales d'initialisation de votre backend
`aliments.php` : implémente les endpoints CRUD pour les aliments
`tests` : dossier contenant les tests unitaires pour les endpoints
`README.md` : description de votre API REST

### Jalon 2 : Le frontend
Le frontend est constitué du code HTML, CSS, JS et PHP qui permet d’envoyer la partie cliente de l’application au navigateur. Il est organisé dans le dossier `frontend` et contient les fichiers suivants :

`js` : dossier contenant les fichiers JavaScript pour le frontend
`css` : dossier contenant les fichiers CSS pour le frontend
`imgs` : dossier contenant les images pour le frontend
`config.php` : contient des variables gloables d'initialiation de votre