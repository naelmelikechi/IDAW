<?php
require_once('initPDO.php');

function getAllUsers() {
    global $pdo; // declaring $pdo as global
    $request = $pdo->prepare("select * from users");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);
    return $users;
}

function createUser($name, $email) {
    global $pdo;
    $request = $pdo->prepare("insert into users (name, email) values (:name, :email)");
    $request->bindParam(':name', $name);
    $request->bindParam(':email', $email);
    $result = $request->execute();
    if ($result) {
        $id = $pdo->lastInsertId();
        $request = $pdo->prepare("select * from users where id = :id");
        $request->bindParam(':id', $id);
        $request->execute();
        $user = $request->fetch(PDO::FETCH_OBJ);
        return $user;
    } else {
        return false;
    }
}

function getUserById($id) {
    global $pdo;
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        return false;
    }
    $request = $pdo->prepare("select * from users where id = :id");
    $request->bindParam(':id', $id);
    $request->execute();
    $user = $request->fetch(PDO::FETCH_OBJ);
    return $user;
}

function deleteUserById($id) {
    global $pdo;
    $request = $pdo->prepare("delete from users where id = :id");
    $request->bindParam(':id', $id);
    $result = $request->execute();
    return $result;
}

function updateUserById($id, $name, $email) {
    global $pdo;
    $request = $pdo->prepare("update users set name = :name, email = :email where id = :id");
    $request->bindParam(':id', $id);
    $request->bindParam(':name', $name);
    $request->bindParam(':email', $email);
    $result = $request->execute();
    return $result;
}


?>
