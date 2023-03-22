<?php
require_once('initPDO.php');

function getAllUsers() {
    global $pdo; // declaring $pdo as global
    $request = $pdo->prepare("select * from users");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);
    return $users;
}
?>
