<?php
session_start();
require_once 'templates/template_header.php';
require_once 'templates/template_menu.php';
require_once 'config.php';

if (!isset($_SESSION['ID_UTILISATEUR'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['ID_UTILISATEUR'];

$currentPage = 'accueil';
renderMenuToHTML($currentPage);
?>

<body>
    <header>
        <h2 id="welcome-message">Bienvenue, </h2>
    </header>

    <section>
        <h2>Indicateurs pour la période (7 derniers jours) :</h2>
    </section>

    <section>
        <h2>Graphiques :</h2>
        <!-- Insérez les éléments de graphique ici (ex. balises canvas pour les bibliothèques de graphiques) -->
    </section>

    <script>
        let api_url = "<?php echo $API_LINK ?>";
        let userId = <?php echo $user_id ?>;
        let date = new Date().toISOString().slice(0, 10);

        function getUserByID() {
            $.ajax({
                url: api_url + '/utilisateurs?id=' + userId,
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                $('#welcome-message').text('Bienvenue ' + response.PRENOM);
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }


        getUserByID();
    </script>

</body>

</html>