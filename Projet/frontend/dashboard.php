<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard des consommations</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">

</head>

<body>
    <h1>Dashboard des consommations</h1>
    <div class="progress-container">
        <div class="progress-label">Calories consommées</div>
        <progress id="progress" max="100" value="0"></progress>
        <div class="progress-value"><span id="consumed">0</span> / <span id="recommended">0</span> kcal</div>
    </div>

    <script>
        $(document).ready(function () {
            <?php require_once("config.php") ?>
            let api_url = "<?php echo $API_LINK ?>";

            let userId = 1;
            let date = "2023-03-29";

            function getUserCalories() {
                return $.ajax({
                    url: api_url + '/consommations/calories?id=' + userId + '&date=' + date,
                    type: 'GET',
                    dataType: 'json',
                })
            }

            function getUserRecommendation() {
                return $.ajax({
                    url: api_url + '/recommandations/calories?id=' + userId,
                    type: 'GET',
                    dataType: 'json',
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
                $('#progress').val(progressValue);
                $('#consumed').text(consumed.toFixed(0));
                $('#recommended').text(recommended.toFixed(0));
            }
            $.when(getUserCalories(), getUserRecommendation()).done(function (caloriesResponse, recommendationResponse) {
                let consumedCalories = caloriesResponse[0].total_calories;
                let recommendedCalories = recommendationResponse[0].APPORT_CALORIQUE_JOURNALIER;
                updateProgressBar(consumedCalories, recommendedCalories);
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        });
    </script>
</body>

</html>