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
function createUser($email, $nom, $prenom, $age, $poids, $sexe, $niveau_activite_sportive)
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

/*---------------------------------------------
-----------fonctions consommations ------------
---------------------------------------------*/

function getAllConsommations()
{
    global $pdo;
    $request = $pdo->prepare("select * from consommations");
    $request->execute();
    $consommations = $request->fetchAll(PDO::FETCH_OBJ);
    return $consommations;
}
function getConsommationById($id)
{
    global $pdo;
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        return false;
    }
    $request = $pdo->prepare("select * from consommations where id_consommation = :id");
    $request->bindParam(':id', $id);
    $request->execute();
    $consommation = $request->fetch(PDO::FETCH_OBJ);
    return $consommation;
}

function createConsommation($id_aliment, $id_utilisateur, $quantite, $date, $heure)
{
    global $pdo;
    $request = $pdo->prepare("insert into consommations (id_aliment, id_utilisateur, quantite, date, heure) values (:id_aliment, :id_utilisateur, :quantite, :date, :heure)");
    $request->bindParam(':id_aliment', $id_aliment);
    $request->bindParam(':id_utilisateur', $id_utilisateur);
    $request->bindParam(':quantite', $quantite);
    $request->bindParam(':date', $date);
    $request->bindParam(':heure', $heure);
    $result = $request->execute();
    if ($result) {
        $id = $pdo->lastInsertId();
        $request = $pdo->prepare("select * from consommations where id_consommation = :id");
        $request->bindParam(':id', $id);
        $request->execute();
        $consommation = $request->fetch(PDO::FETCH_OBJ);
        return $consommation;
    } else {
        return false;
    }
}

function updateConsommationById($id_consommations, $id_aliment, $id_utilisateur, $quantite, $date, $heure)
{
    global $pdo;
    $request = $pdo->prepare("update consommations set id_aliment = :id_aliment, id_utilisateur = :id_utilisateur, quantite = :quantite, date = :date, heure = :heure where id_consommation = :id_consommations");
    $request->bindParam(':id_consommations', $id_consommations);
    $request->bindParam(':id_aliment', $id_aliment);
    $request->bindParam(':id_utilisateur', $id_utilisateur);
    $request->bindParam(':quantite', $quantite);
    $request->bindParam(':date', $date);
    $request->bindParam(':heure', $heure);
    $result = $request->execute();
    return $result;
}

function getConsommationByUserID($id_utilisateur)
{
    global $pdo;
    $request = $pdo->prepare("select * from consommations where id_utilisateur = :id_utilisateur");
    $request->bindParam(':id_utilisateur', $id_utilisateur);
    $request->execute();
    $consommations = $request->fetchAll(PDO::FETCH_OBJ);
    return $consommations;
}
function deleteConsommationById($id)
{
    global $pdo;
    $request = $pdo->prepare("delete from consommations where id_consommation = :id");
    $request->bindParam(':id', $id);
    $result = $request->execute();
    return $result;
}



function getTotalCaloriesByUserIdAndDate($id_utilisateur, $date)
{
    global $pdo;
    $sql = "SELECT COALESCE(SUM(aliments.CALORIES_100G * consommations.QUANTITE / 100), 0) as total_calories FROM consommations INNER JOIN aliments ON aliments.ID_ALIMENT = consommations.ID_ALIMENT WHERE consommations.ID_UTILISATEUR = :id_utilisateur AND consommations.DATE = :date";
    $request = $pdo->prepare($sql);
    $request->bindParam(':id_utilisateur', $id_utilisateur);
    $request->bindParam(':date', $date);
    // var_dump($sql, $id_utilisateur, $date); // Debugging statement
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);
    return $result['total_calories'];
}
function getRecommandationCaloriesByUserId($user_id)
{
    global $pdo;
    $sql = "SELECT APPORT_CALORIQUE_JOURNALIER FROM profil_recommandation
            JOIN utilisateurs ON profil_recommandation.ID_PROFIL = utilisateurs.ID_UTILISATEUR
            WHERE utilisateurs.ID_UTILISATEUR = :user_id";
    $request = $pdo->prepare($sql);
    $request->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);

    return $result;
}


?>