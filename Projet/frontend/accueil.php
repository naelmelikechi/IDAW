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

        function getConsumptionData() {
    const url = api_url + '/consommation/userspecifique?id=' + userId;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
    }).done(function(response) {
        console.log("API response:", response);

        let consumptionData = [];
        let recommendationData = [];
        let labels = [];

                const currentDate = new Date();
                for (let i = 6; i >= 0; i--) {
                    const pastDate = new Date(currentDate.getTime() - (i * 24 * 60 * 60 * 1000));
                    const pastDateString = pastDate.toISOString().slice(0, 10);
                    labels.push(pastDateString);

            // Trouver les données pour la date actuelle en utilisant la propriété DATE
            const dailyData = response.find(d => d.DATE === pastDateString);
            console.log("Daily data for", pastDateString, dailyData);
            if (dailyData) {
                consumptionData.push(dailyData.consomme);
                recommendationData.push(dailyData.recommande);
            } else {
                consumptionData.push(0);
                recommendationData.push(0);
            }
        }
        console.log("labels:", labels);
        console.log("consumptionData:", consumptionData);
        console.log("recommendationData:", recommendationData);

        displayIndicators(consumptionData, recommendationData);
        displayConsumptionChart(labels, consumptionData, recommendationData);
    }).fail(function(error) {
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
}
        function displayIndicators(consumptionData, recommendationData) {
            let totalConsumption = consumptionData.reduce((a, b) => a + b, 0);
            let avgConsumption = totalConsumption / consumptionData.length;
            let recommendedIntake = recommendationData[0];

            $('#total-consumption').text(totalConsumption.toFixed(2));
            $('#avg-consumption').text(avgConsumption.toFixed(2));
            $('#recommended-intake').text(recommendedIntake.toFixed(2));
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
                            data: recommendationData,
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
        getConsumptionData();
    </script>

</body>

</html>