<?php
session_start();
require_once 'config.php';
require_once 'init_pdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($username)) {
        echo json_encode(['success' => false, 'message' => 'Veuillez entrer un nom d\'utilisateur.']);
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE username = :username OR nom = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && (empty($password) || password_verify($password, $user['password']) || $username == $user['NOM'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo json_encode(['success' => true, 'message' => 'Connexion réussie.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Login ou mot de passe incorrect.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la connexion à la base de données : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}