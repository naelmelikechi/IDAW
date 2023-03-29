<?php
require_once('initPDO.php');

/*---------------------------------------------
-----------fonctions utilisateur --------------
---------------------------------------------*/

function getAllUsers()
{
    global $pdo; // declaring $pdo as global
    $request = $pdo->prepare("select * from utilisateurs");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);
    return $users;
}

function getUserById($id)
{
    global $pdo;
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        return false;
    }
    $request = $pdo->prepare("select * from utilisateurs where id_utilisateur = :id");
    $request->bindParam(':id', $id);
    $request->execute();
    $user = $request->fetch(PDO::FETCH_OBJ);
    return $user;
}






function deleteUserById($id)
{
    global $pdo;
    $request = $pdo->prepare("delete from utilisateurs where id_utilisateur = :id");
    $request->bindParam(':id', $id);
    $result = $request->execute();
    return $result;
}

function updateUserById($id, $email, $nom, $prenom, $age, $poids, $sexe, $niveau_activite_sportive)
{
    global $pdo;
    $request = $pdo->prepare("UPDATE utilisateurs SET email = :email, nom = :nom, prenom = :prenom, age = :age, poids = :poids, sexe = :sexe, niveau_activite_sportive = :niveau_activite_sportive WHERE id_utilisateur = :id");
    $request->bindParam(':id', $id);
    $request->bindParam(':email', $email);
    $request->bindParam(':nom', $nom);
    $request->bindParam(':prenom', $prenom);
    $request->bindParam(':age', $age);
    $request->bindParam(':poids', $poids);
    $request->bindParam(':sexe', $sexe);
    $request->bindParam(':niveau_activite_sportive', $niveau_activite_sportive);
    $result = $request->execute();
    return $result;
}

/*---------------------------------------------
-------------fonctions aliments ---------------
---------------------------------------------*/

function getAllAliments()
{
    global $pdo;
    $request = $pdo->prepare("select * from aliments");
    $request->execute();
    $aliments = $request->fetchAll(PDO::FETCH_OBJ);
    return $aliments;
}

function getAlimentById($id)
{
    global $pdo;
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        return false;
    }
    $request = $pdo->prepare("select * from aliments where id_aliment = :id");
    $request->bindParam(':id', $id);
    $request->execute();
    $aliment = $request->fetch(PDO::FETCH_OBJ);
    return $aliment;
}

function createUser($email,$nom, $prenom, $age, $poids, $sexe, $niveau_activite_sportive)
{
    global $pdo;
    $request = $pdo->prepare("insert into utilisateurs (email, nom, prenom, age, poids, sexe, niveau_activite_sportive) VALUES (:email, :nom, :prenom, :age, :poids, :sexe, :niveau_activite_sportive)");
    $request->bindParam(':email', $email);
    $request->bindParam(':nom', $nom);
    $request->bindParam(':prenom', $prenom);
    $request->bindParam(':age', $age);
    $request->bindParam(':poids', $poids);
    $request->bindParam(':sexe', $sexe);
    $request->bindParam(':niveau_activite_sportive', $niveau_activite_sportive);
    $result = $request->execute();
    if ($result) {
        $id = $pdo->lastInsertId();
        $request = $pdo->prepare("select * from utilisateurs WHERE id_utilisateur = :id");
        $request->bindParam(':id', $id);
        $request->execute();
        $user = $request->fetch(PDO::FETCH_OBJ);
        return $user;
    } else {
        return false;
    }
}
function createAliment($libelle_aliment, $calories_100g)
{
    global $pdo;
    $request = $pdo->prepare("insert into aliments (libelle_aliment, calories_100g) values (:libelle_aliment, :calories_100g)");
    $request->bindParam(':libelle_aliment', $libelle_aliment);
    $request->bindParam(':calories_100g', $calories_100g);
    $result = $request->execute();
    if ($result) {
        $id = $pdo->lastInsertId();
        $request = $pdo->prepare("select * from aliments where id_aliment = :id");
        $request->bindParam(':id', $id);
        $request->execute();
        $aliment = $request->fetch(PDO::FETCH_OBJ);
        return $aliment;
    } else {
        return false;
    }
}

function deleteAlimentById($id)
{
    global $pdo;
    $request = $pdo->prepare("delete from aliments where id_aliment = :id");
    $request->bindParam(':id', $id);
    $result = $request->execute();
    return $result;
}

function updateAlimentById($id, $libelle_aliment, $calories_100g)
{
    global $pdo;
    $request = $pdo->prepare("update aliments set libelle_aliment = :libelle_aliment, calories_100g = :calories_100g where id_aliment = :id");
    $request->bindParam(':id', $id);
    $request->bindParam(':libelle_aliment', $libelle_aliment);
    $request->bindParam(':calories_100g', $calories_100g);
    $result = $request->execute();
    return $result;
}

?>