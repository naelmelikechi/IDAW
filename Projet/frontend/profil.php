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
    <h1>Liste des utilisateurs</h1>
    <table id="users-table" class="display">
        <thead>
            <tr>
                <th>Email</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Age</th>
                <th>Poids</th>
                <th>Sexe</th>
                <th>Niveau activité sportive</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <!-- <form id="edit-user-form" style="display: none;">
        <h2>Modifier un utilisateur</h2>
        <input type="hidden" id="idEdit" name="idEdit">
        <label for="nameEdit">Nom:</label>
        <input type="text" id="nameEdit" name="nameEdit">
        <label for="emailEdit">Email:</label>
        <input type="email" id="emailEdit" name="emailEdit">
        <input type="submit" value="Enregistrer">
    </form>
    <h2>Ajouter un utilisateur</h2>
    <form id="add-user-form">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <input type="submit" value="Ajouter">
    </form> -->
</body>
<script>
    $(document).ready(function () {
        <?php require_once("config.php") ?>
        let api_url = "<?php echo $API_LINK ?>";
        function getUserCalories() {
            $.ajax({
                url: api_url + '/consommations/calories?id=1',
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                let apportCalorique = response.total_calories;
                alert(apportCalorique);
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        function getUserRecommendation() {
            $.ajax({
                url: api_url + '/recommandations/calories?id=1',
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                let apportCaloriqueRecommendation = response.APPORT_CALORIQUE_JOURNALIER;
                alert(apportCaloriqueRecommendation);
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }
        getUserCalories();
        getUserRecommendation();


    
    });
</script>

</html>