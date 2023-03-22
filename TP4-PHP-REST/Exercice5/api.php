<?php
require_once('users.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $users = getAllUsers();
    echo json_encode($users);
}
?>
