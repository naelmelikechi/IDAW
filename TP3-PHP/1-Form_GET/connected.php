<?php
if (isset($_GET['login']) && isset($_GET['password'])) {
    $login = $_GET['login'];
    $password = $_GET['password'];
    echo "<p>Login : $login.</p>";
    echo "<p>Mot de passe : $password.</p>";
} else {
    echo "<p>Login et Password non définis</p>";
}
?>