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
        <div id="indicators">
            <p>Consommation totale : <span id="total-consumption"></span> kcal</p>
            <p>Consommation moyenne par jour : <span id="avg-consumption"></span> kcal</p>
            <p>Recommandation moyenne par jour : <span id="recommended-intake"></span> kcal</p>
        </div>
    </section>

    <section>
        <h2>Graphiques :</h2>
        <div>
            <canvas id="consumptionChart"></canvas>
        </div>
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

        function getSevenLastConsumptions() {
            let endDate = new Date().toISOString().slice(0, 10); // Today's date
            let startDate = new Date();
            startDate.setDate(startDate.getDate() - 6); // 6 days ago
            startDate = startDate.toISOString().slice(0, 10);

            let requests = [];
            let dates = [];
            let dailyRecommendation = 2000;

            for (let i = 0; i < 7; i++) {
                let date = new Date(startDate);
                date.setDate(date.getDate() + i);
                dates.push(date.toISOString().slice(0, 10));

                requests.push(
                    $.ajax({
                        url: api_url + '/consommations/calories?id=' + userId + '&date=' + dates[i],
                        type: 'GET',
                        dataType: 'json',
                    })
                );
            }

            $.ajax({
                url: api_url + '/recommandations/calories?id=' + userId,
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                dailyRecommendation = response.APPORT_CALORIQUE_JOURNALIER;
                $.when.apply($, requests).done(function () {
                    let consumptionData = [];
                    let labels = [];

                    for (let i = 0; i < 7; i++) {
                        let response = arguments[i][0];
                        if (response && response.total_calories) {
                            consumptionData.push(parseFloat(response.total_calories));
                            labels.push(dates[i]);
                        } else if (response && response.consomations && response.consomations.length > 0) {
                            consumptionData.push(response.consomations[0].calories);
                            labels.push(dates[i]);
                        } else {
                            console.error('Error: Unexpected response format for date', dates[i], response);
                        }
                    }

                    displayIndicators(consumptionData, dailyRecommendation);
                    displayConsumptionChart(labels, consumptionData, dailyRecommendation);
                }).fail(function (error) {
                    alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                });
            }).fail(function (error) {
                console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        function displayIndicators(consumptionData, recommendationData) {
            let totalConsumption = consumptionData.reduce((a, b) => a + b, 0);
            let avgConsumption = totalConsumption / consumptionData.length;
            let recommendedIntake = recommendationData;

            $('#total-consumption').text(totalConsumption.toFixed(2));
            $('#avg-consumption').text(avgConsumption.toFixed(2));
            $('#recommended-intake').text(recommendedIntake);
        }

        function displayConsumptionChart(labels, consumptionData, recommendationData) {
            const ctx = document.getElementById('consumptionChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Consommation',
                            data: consumptionData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.1
                        },
                        {
                            label: 'Recommandation',
                            data: new Array(consumptionData.length).fill(recommendationData),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        getUserByID();
        getSevenLastConsumptions();
    </script>

</body>

</html>