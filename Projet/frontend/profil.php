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

$currentPage = 'profil';
renderMenuToHTML($currentPage);
?>

<body>
    <header>
        <h2 id="profile-title">Profil utilisateur</h2>
    </header>

    <section id="user-info">
        <h3>Informations personnelles</h3>
        <div id="user-details">
            <p>Nom : <span id="user-nom"></span></p>
            <p>Prénom : <span id="user-prenom"></span></p>
            <p>Email : <span id="user-email"></span></p>
            <p>Age : <span id="user-age"></span></p>
            <p>Poids : <span id="user-poids"></span></p>
            <p>Sexe : <span id="user-sexe"></span></p>
            <p>Niveau d'activité sportive : <span id="user-niveau_activite_sportive"></span></p>
        </div>
    </section>
    <section id="nutriments-recommendations">
    <h3>Recommandations en nutriments</h3>
    <table id="nutriments-table">
        <thead>
            <tr>
                <th>Nutriment</th>
                <th>Quantité journalière recommandée</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</section>

    <script>
        let api_url = "<?php echo $API_LINK ?>";
        let userId = <?php echo $user_id ?>;

        function getUserByID() {
            $.ajax({
                url: api_url + '/utilisateurs?id=' + userId,
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                $('#user-nom').text(response.NOM);
                $('#user-prenom').text(response.PRENOM);
                $('#user-email').text(response.EMAIL);
                $('#user-age').text(response.AGE);
                $('#user-poids').text(response.POIDS);
                $('#user-sexe').text(response.SEXE);
                $('#user-niveau_activite_sportive').text(response.NIVEAU_ACTIVITE_SPORTIVE);
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }
        function getNutrimentsRecommendations() {
    $.ajax({
        url: api_url + '/recommandations/nutriments?id=' + userId,
        type: 'GET',
        dataType: 'json',
    }).done(function (response) {
        let nutrimentsTableBody = $('#nutriments-table tbody');
        response.forEach(function (nutriment) {
            let newRow = `<tr>
                            <td>${nutriment.LIBELLE_NUTRIMENT}</td>
                            <td>${nutriment.QUANTITE_JOURNALIERE}</td>
                          </tr>`;
            nutrimentsTableBody.append(newRow);
        });
    }).fail(function (error) {
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
}
        

        getUserByID();
        getNutrimentsRecommendations();
    </script>
</body>

</html>