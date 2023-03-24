<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Utilisateurs</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Liste des utilisateurs</h1>
    <table id="users-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <h2>Ajouter un utilisateur</h2>
    <form id="add-user-form">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <input type="submit" value="Ajouter">
    </form>
</body>
<script>

    $(document).ready(function () {
        <?php require_once("config.php") ?>
        let api_url = "<?php echo $API_LINK ?>";

        function showUsers() {
            $.ajax({
                url: api_url + 'api.php',
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                $.each(response, function (index, user) {
                    $('#users-table').append('<tr><td>' + user.name + '</td><td>' + user.email + '</td><td><button class="delete-user" data-id="' + user.id + '">Delete</button>&nbsp<button class="edit-user" data-id="' + user.id + '">Edit</button></td></tr>');
                });
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        function userDelete(userID) {
            $.ajax({
                url: api_url + 'api.php?id=' + userID,
                type: 'DELETE',
                dataType: 'json',
            }).done(function (response) {
                $('button.delete-user[data-id="' + userID + '"]').closest('tr').remove();
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        $(document).on('click', '.delete-user', function () {
            var userID = $(this).data('id');
            userDelete(userID);
        });



        showUsers();
    });

</script>

</html>