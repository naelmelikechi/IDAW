<?php
    session_start();
    $users = array(
        // login => password
        'riri' => 'fifi',
        'yoda' => 'maitrejedi'
    );
    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin = $_POST['login'];
        $tryPwd = $_POST['password'];
        if (array_key_exists($tryLogin, $users) && $users[$tryLogin] == $tryPwd) {
            $successfullyLogged = true;
            $login = $tryLogin;
            $_SESSION['login'] = $login;
        } else
            $errorText = "Erreur de login/password";
    } else
        $errorText = "Merci d'utiliser le formulaire de login";
    if (!$successfullyLogged) {
        echo $errorText;
    } else {
        echo "<h1>Bienvenue " . $_SESSION['login'] . "</h1>";
    }
?>