<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Utilisateurs</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <h1>Dashboard des consommations</h1>
    <div>
        <label for="progress">Progress:</label>
        <progress id="progress" max="100" value="0"></progress>
    </div>
</body>
<script>
    $(document).ready(function () {
    <?php require_once("config.php") ?>
    let api_url = "<?php echo $API_LINK ?>";

    function getUserCalories() {
        return $.ajax({
            url: api_url + '/consommations/calories?id=1&date=2023-03-29',
            type: 'GET',
            dataType: 'json',
        });
    }

    function getUserRecommendation() {
        return $.ajax({
            url: api_url + '/recommandations/calories?id=1',
            type: 'GET',
            dataType: 'json',
        });
    }

    function updateProgressBar(consumed, recommended) {
        console.log("consumed:", consumed);
        console.log("recommended:", recommended);
        let progressValue;
        if (consumed > 0 && recommended > 0 && isFinite(consumed) && isFinite(recommended)) {
            progressValue = (consumed / recommended) * 100;
        } else {
            progressValue = 0;
        }
        console.log("progressValue:", progressValue);
        $('#progress').val(progressValue);
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

</html>