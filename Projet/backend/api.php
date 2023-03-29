<?php
require_once('functionsAPI.php');

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'];

echo $path; 

if ($method == 'GET') {

    switch ($path) {
        case '/utilisateurs':
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
            break;
        case '/aliments':
            // code pour la requête GET pour l'URL /data
            if (isset($_GET['id'])) {
                $aliment = getAlimentById($_GET['id']);
                if ($aliment) {
                    echo json_encode($aliment);
                } else {
                    header('HTTP/1.1 404 Not Found');
                    echo json_encode(['error' => 'Aliment not found']);
                }
            } else {
                $aliments = getAllAliments();
                echo json_encode($aliments);
            }
            break;
        default:
            // code pour gérer les URL invalides
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Invalid URL']);
            break;
    }


}

if ($method == 'POST') {

    switch ($path) {
        case '/utilisateurs':
            $data = json_decode(utf8_encode(file_get_contents('php://input')), true);
            print_r($data);
            $user = createUser($data['email'], $data['nom'], $data['prenom'], $data['age'], $data['poids'], $data['sexe'], $data['niveau_activite_sportive']);
             if ($user) {
                 header('HTTP/1.1 201 Created');
                 echo json_encode($user);
             } else {
                 header('HTTP/1.1 400 Bad Request');
                 echo json_encode(['error' => 'Could not create user']);
            }
            break;
        case '/aliments':
            $data = json_decode(utf8_encode(file_get_contents('php://input')), true);
            $aliment = createAliment($data['libelle_aliment'], $data['calories_100g']);
            if ($aliment) {
                header('HTTP/1.1 201 Created');
                echo json_encode($aliment);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['error' => 'Could not create aliment']);
            }
            break;
        default:
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Invalid URL']);
            break;
    }
}

if ($method == 'DELETE') {

    switch ($path) {
        case '/utilisateurs':
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
            break;
        case '/aliments':
            if (isset($_GET['id'])) {
                $result = deleteAlimentById($_GET['id']);
                if ($result) {
                    header('HTTP/1.1 204 No Content');
                } else {
                    header('HTTP/1.1 404 Not Found');
                    echo json_encode(['error' => 'Aliment not found']);
                }
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['error' => 'Missing ID parameter']);
            }
            break;
        default:
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Invalid URL']);
            break;

    }
}

if ($method == 'PUT') {
    switch ($path) {
        case '/utilisateurs':
            $data = json_decode(utf8_encode(file_get_contents('php://input')), true);
            $result = updateUserById($_GET['id'], $data['email'], $data['nom'], $data['prenom'], $data['age'], $data['poids'], $data['sexe'], $data['niveau_activite_sportive']);
            if ($result) {
                echo json_encode(['success' => 'User updated successfully']);
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['error' => 'User not found']);
            }
            break;
        case '/aliments':
            $data = json_decode(utf8_encode(file_get_contents('php://input')), true);
            $result = updateAlimentById($_GET['id'], $data['libelle_aliment'], $data['calories_100g']);
            if ($result) {
                echo json_encode(['success' => 'Aliment updated successfully']);
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['error' => 'Aliment not found']);
            }
            break;
        default:
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Invalid URL']);
            break;
    }
}
?>