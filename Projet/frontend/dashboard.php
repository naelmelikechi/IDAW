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

$currentPage = 'dashboard';
renderMenuToHTML($currentPage);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard des consommations</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>

<body>

    <h1>Dashboard de vos consommations</h1>
    <h2 id="welcome-message">Bonjour</h2>
    <div class="date-container">
        <label for="date-selector">Sélectionnez une date :</label>
        <input type="date" id="date-selector">
    </div>
    <div class="progress-container">
        <div class="progress-label">Calories consommées</div>
        <progress id="progress" max="100" value="0"></progress>
        <div class="progress-value"><span id="consumed">0</span> / <span id="recommended">0</span> kcal</div>
    </div>
    <br>
    <table id="consommations-table" class="display">
        <thead>
            <tr>
                <th>Nom de l'aliment consommé</th>
                <th>Quantité (en grammes) </th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
        </thead>
    </table>

    <script>
        let api_url = "<?php echo $API_LINK ?>";
        let userId = <?php echo $user_id ?>;
        let date = new Date().toISOString().slice(0, 10);




        $('#date-selector').val(date);

        function getUserCalories() {
            return $.ajax({
                url: api_url + '/consommations/calories?id=' + userId + '&date=' + date,
                type: 'GET',
                dataType: 'json',
            })
        }

        function getUserRecommendation() {
            return $.ajax({
                url: api_url + '/recommandations/calories?id=' + userId + '&date=' + date,
                type: 'GET',
                dataType: 'json',
            });
        }

        let consommationsTable = $('#consommations-table').DataTable({
            columns: [
                { data: "LIBELLE_ALIMENT" },
                { data: "QUANTITE" },
                { data: "DATE" },
                { data: "HEURE" }
            ]
        });


        function getUserConsommation() {
            return $.ajax({
                url: api_url + '/consommation/id_date?id=' + userId + '&date=' + date,
                type: 'GET',
                dataType: 'json',
            }).always(function (response) {
                let consommations = response;
                let dataTableData = [];

                if (consommations && consommations.length > 0) {
                    for (let i = 0; i < consommations.length; i++) {
                        let consommation = consommations[i];
                        dataTableData.push({
                            "LIBELLE_ALIMENT": consommation.LIBELLE_ALIMENT,
                            "QUANTITE": consommation.QUANTITE,
                            "DATE": consommation.DATE,
                            "HEURE": consommation.HEURE.slice(11, 16)
                        });
                    }
                }

                consommationsTable.clear().rows.add(dataTableData).draw();
            });
        }





        function updateProgressBar(consumed, recommended) {
            let progressValue;
            consumed = Number(consumed);
            recommended = Number(recommended);
            if (consumed > 0 && recommended > 0 && isFinite(consumed) && isFinite(recommended)) {
                progressValue = Math.min((consumed / recommended) * 100, 100);
            } else {
                progressValue = 0;
            }

            $('#consumed').text(consumed.toFixed(0));
            $('#recommended').text(recommended.toFixed(0));

            $('#progress').animate({
                'value': progressValue
            }, 800);
        }

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

        $('#date-selector').on('change', function () {
            date = $(this).val();
            $.when(getUserCalories(), getUserRecommendation()).done(function (caloriesResponse, recommendationResponse) {
                let consumedCalories = caloriesResponse[0].total_calories;
                let recommendedCalories = recommendationResponse[0].APPORT_CALORIQUE_JOURNALIER;
                updateProgressBar(consumedCalories, recommendedCalories);
                getUserConsommation();
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        });


        $.when(getUserCalories(), getUserRecommendation()).done(function (caloriesResponse, recommendationResponse) {
            let consumedCalories = caloriesResponse[0].total_calories;
            let recommendedCalories = recommendationResponse[0].APPORT_CALORIQUE_JOURNALIER;
            updateProgressBar(consumedCalories, recommendedCalories);
        }).fail(function (error) {
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
        getUserByID();
        getUserConsommation();

    </script>

</html>