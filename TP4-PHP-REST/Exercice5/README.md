Le code fourni implémente une API RESTful pour la gestion des utilisateurs (users). Voici les différents endpoints de cette API :

#Endpoint pour récupérer tous les utilisateurs
URL : '/api.php'
Méthode HTTP : 'GET'
Paramètres : aucun
Réponse : un tableau JSON contenant tous les utilisateurs enregistrés, chaque utilisateur étant représenté par un objet JSON ayant les propriétés id, name, et email.
#Endpoint pour récupérer un utilisateur spécifique
URL : '/api.php?id={id}'
Méthode HTTP : GET
Paramètres :
id : l'identifiant de l'utilisateur à récupérer (entier)
Réponse :
Si l'utilisateur existe, retourne un objet JSON représentant l'utilisateur, avec les propriétés id, name, et email.
Si l'utilisateur n'existe pas, retourne une réponse avec le code HTTP 404 "Not Found", et un objet JSON contenant la propriété error avec la valeur "User not found".