<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Utilisateurs</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Liste des utilisateurs</h1>
    <table id="users-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <form id="edit-user-form" style="display: none;">
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
                $('#users-table').DataTable({
                    data: response,
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'email' },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<button class="delete-user" data-id="' + data.id + '">Delete</button>&nbsp<button class="edit-user" data-id="' + data.id + '">Edit</button>';
                            }
                        }
                    ]
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
                $('#users-table').DataTable().row($('button.delete-user[data-id="' + userID + '"]').closest('tr')).remove().draw();
            }).fail(function (error) {

                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        function getUserByID(userID) {
            $.ajax({
                url: api_url + 'api.php?id=' + userID,
                type: 'GET',
                dataType: 'json',
            }).done(function (response) {
                $('#edit-user-form').show();
                $('#idEdit').val(response.id);
                $('#nameEdit').val(response.name);
                $('#emailEdit').val(response.email);
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        function addUser(name, email) {
            $.ajax({
                url: api_url + 'api.php',
                type: 'POST',
                data: JSON.stringify({ "name": name, "email": email }),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
            }).done(function (response) {
                $('#users-table').DataTable().row.add(response).draw();
                console.log('Utilisateur ajouté avec succès !');
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        function editUserByID(userID, name, email) {
            $.ajax({
                url: api_url + 'api.php?id=' + userID,
                type: 'PUT',
                data: JSON.stringify({ "name": name, "email": email }),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
            }).done(function (response) {
                $('#edit-user-form').hide();
                var table = $('#users-table').DataTable();
                var row = table.row($('button.edit-user[data-id="' + userID + '"]').closest('tr'));
                row.data(response).draw();
                console.log('Utilisateur modifié avec succès !');
            }).fail(function (error) {
                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            });
        }

        $(document).on('click', '.delete-user', function () {
            var userID = $(this).data('id');
            userDelete(userID);
        });

        $(document).on('click', '.edit-user', function () {
            var userID = $(this).data('id');
            getUserByID(userID);
        });

        $(document).on('click', '#add-user-form input[type="submit"]', function () {
            var name = $('#name').val();
            var email = $('#email').val();
            addUser(name, email);
        });

        $(document).on('click', '#edit-user-form input[type="submit"]', function () {
            var id = $('#idEdit').val();
            var name = $('#nameEdit').val();
            var email = $('#emailEdit').val();
            editUserByID(id, name, email);
        });

        showUsers();
    });
</script>

</html>