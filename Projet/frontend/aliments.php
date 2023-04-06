<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ajouter une consommation</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <h1>Ajouter une consommation</h1>

    <form id="add-consommation-form">
        <label for="aliment">Aliment:</label>
        <select name="aliment" id="aliment">
        </select><br>

        <label for="quantite">Quantité:</label>
        <input type="number" name="quantite" id="quantite"><br>

        <label for="date">Date:</label>
        <input type="date" name="date" id="date"><br>

        <label for="heure">Heure:</label>
        <input type="time" name="heure" id="heure"><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
<script>
    $(document).ready(function () {
        <?php require_once("config.php") ?>
        let api_url = "<?php echo $API_LINK ?>";

        let userId = 36;
        console.log("ready");
        // récupérer les aliments depuis la base de données et les ajouter à la liste déroulante
        $.ajax({
            url: api_url + '/aliments',
            type: 'GET',
            dataType: 'json'
        }).done(function (response) {
            console.log("ok");
            for (var i = 0; i < response.length; i++) {
                $('#aliment').append('<option value="' + response[i].id_aliment + '">' + response[i].LIBELLE_ALIMENT + '</option>');
            }
        }).fail(function (error) {
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });

        // soumettre le formulaire pour ajouter une consommation
        $('#add-consommation-form').submit(function (event) {
            event.preventDefault();

            // récupérer les données du formulaire
            var id_aliment = $('#aliment').val();
            var quantite = $('#quantite').val();
            var date = $('#date').val();
            var heure = $('#heure').val();

            // envoyer la requête AJAX pour créer la consommation
            $.ajax({
                url: api_url + '/consommations',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({
                    id_aliment: id_aliment,
                    id_utilisateur: userId, // vous devez définir userId quelque part
                    quantite: quantite,
                    date: date,
                    heure: heure
                }),
                contentType: 'application/json'
            }).done(function (response) {
                // mise à jour de la table de consommation avec les données récemment ajoutées
                getUserConsommation();
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        });
    });
</script>

</html>