<?php
/*if (isset($_GET['login']) && isset($_GET['password'])) {
$login = $_GET['login'];
$password = $_GET['password'];
echo "<p>Login : $login.</p>";
echo "<p>Mot de passe : $password.</p>";
} else {
echo "<p>Login et Password non définis</p>";
}*/

// on simule une base de données
$users = array(
    // login => password
    'riri' => 'fifi',
    'yoda' => 'maitrejedi'
);
$login = "anonymous";
$errorText = "";
$successfullyLogged = false;
if (isset($_GET['login']) && isset($_GET['password'])) {
    $tryLogin = $_GET['login'];
    $tryPwd = $_GET['password'];
    // si login existe et password correspond
    if (array_key_exists($tryLogin, $users) && $users[$tryLogin] == $tryPwd) {
        $successfullyLogged = true;
        $login = $tryLogin;
    } else
        $errorText = "Erreur de login/password";
} else
    $errorText = "Merci d'utiliser le formulaire de login";
if (!$successfullyLogged) {
    echo $errorText;
} else {
    echo "<h1>Bienvenue" . $login . "</h1>";
}

?>