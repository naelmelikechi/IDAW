# ENDPOINTS
Le code fourni implémente une API REST pour la gestion des utilisateurs (users). Voici les différents endpoints de cette API :
## Récupérer tous les utilisateurs
- URL : `/api.php`
- Méthode HTTP : `GET`
- Paramètre d'URL :  
    - aucun
- Réponse : 
    - un tableau JSON contenant tous les utilisateurs enregistrés, chaque utilisateur étant représenté par un objet JSON ayant les propriétés `id`, `name`, et `email`.
## Récupérer un utilisateur spécifique
- URL : `/api.php?id={id}`
- Méthode HTTP : `GET`
- Paramètre d'URL :
    - `id` : l'identifiant de l'utilisateur à récupérer (entier)
- Réponse : 
    - Si l'utilisateur existe, retourne un objet JSON représentant l'utilisateur, avec les propriétés `id`, `name`, et `email`. 
    - Si l'utilisateur n'existe pas, retourne une réponse avec le code HTTP 404 "Not Found", et un objet JSON contenant la propriété error avec la valeur "User not found".

## Créer un utilisateur
- URL : `/api.php`
- Méthode HTTP : `POST`
- Paramètre d'URL : 
    - aucun
- Corps de la requête : JSON avec les champs `name` et `email`
    - Exemple de corps de requête : `{"name": "John Wick","email": "johnwick@gmail.com"}`
- Réponse :
    - En cas de succès : code HTTP 201 Created et JSON représentant l'utilisateur créé, avec son ID auto-incrémenté.
    - En cas d'erreur : code HTTP 400 Bad Request et JSON avec le champ error contenant une description de l'erreur.

## Supprimer un utilisateur par son ID
- URL : `/api.php?id={ID}`
- Méthode HTTP : `DELETE`
- Paramètre d'URL : 
    - `id` de l'utilisateur à supprimer
- Réponse :
    - En cas de succès : code HTTP 204 No Content (pas de contenu à renvoyer)
    - En cas d'erreur : code HTTP 404 Not Found et JSON avec le champ error contenant une description de l'erreur.

## Mettre à jour un utilisateur par son ID
- URL : `/api.php?id={ID}`
- Méthode HTTP : `PUT`
- Paramètre d'URL : 
    - `id` de l'utilisateur à mettre à jour
- Corps de la requête : JSON avec les champs `name` et `email`
    - Exemple de corps de requête : `{"name": "John Wick","email": "johnwick@gmail.com"}`
- Réponse :
    - En cas de succès : code HTTP 200 OK et JSON avec le champ success contenant une description de la mise à jour réussie.
    - En cas d'erreur : code HTTP 404 Not Found et JSON avec le champ error contenant une description de l'erreur.