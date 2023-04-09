<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ajouter une consommation</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>

<header>
    <div class="header-container">
        <h1 class="site-title">iMangerMieux</h1>
    </div>
</header>


<body>
    <?php require_once("frontend/config.php"); ?>
    <h1>Connexion</h1>
    <form id="login-form" method="POST">
        <label for="email">Adresse email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>
    <div id="error-message"></div>
</body>

<script>
    $(document).ready(function () {

        let api_url = "<?php echo $API_LINK ?>";
        function loginUser(email, password) {
            return $.ajax({
                url: api_url + '/login' + '?email=' + email + '&password=' + password,
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                console.log(response.ID_UTILISATEUR);
                window.location.href = 'frontend/accueil.php';
            }).fail(function (error) {
                console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        $('#login-form').submit(function (e) {
            e.preventDefault();
            let email = $('#email').val();
            let password = $('#password').val();
            loginUser(email, password);
        });


    });
</script>

</html>