<?php
require_once('users.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    if (isset($_GET['id'])) {
        $user = getUserById($_GET['id']);
        if ($user) {
            echo json_encode($user);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        $users = getAllUsers();
        echo json_encode($users);
    }
}

if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user = createUser($data['name'], $data['email']);
    if ($user) {
        header('HTTP/1.1 201 Created');
        echo json_encode($user);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Could not create user']);
    }
}

if ($method == 'DELETE') {
    if (isset($_GET['id'])) {
        $result = deleteUserById($_GET['id']);
        if ($result) {
            header('HTTP/1.1 204 No Content');
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Missing ID parameter']);
    }
}

if ($method == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = updateUserById($_GET['id'], $data['name'], $data['email']);
    if ($result) {
        echo json_encode(['success' => 'User updated successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}
?>
