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

$currentPage = 'aliments';
renderMenuToHTML($currentPage);
?>

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
        let api_url = "<?php echo $API_LINK ?>";
        let userId = <?php echo $user_id ?>;
        $.ajax({
            url: api_url + '/aliments',
            type: 'GET',
            dataType: 'json'
        }).done(function (response) {
            for (var i = 0; i < response.length; i++) {
                $('#aliment').append('<option value="' + response[i].ID_ALIMENT + '">' + response[i].LIBELLE_ALIMENT + '</option>');
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
            console.log("idaliemnt = " + id_aliment);
            console.log("quantite = " + quantite);
            console.log("date = " + date);
            console.log("heure = " + heure);
            console.log("userID = " + userId);

            // envoyer la requête AJAX pour créer la consommation
            $.ajax({
                url: api_url + '/consommations',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({

                    id_aliment: id_aliment,
                    id_utilisateur: userId,
                    quantite: quantite,
                    date: date,
                    heure: heure
                }),
                contentType: 'application/json'
            }).done(function (response) {
                console.log(response);
            }).fail(function (error) {
                console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        });
    });
</script>

</html>