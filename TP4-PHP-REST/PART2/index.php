<?php
require_once('initPDO.php');
//require_once('db_init.php');

if (isset($_POST['name_user']) && isset($_POST['email_user'])) {
    $name = $_POST['name_user'];
    $email = $_POST['email_user'];
    $insert = $pdo->prepare("INSERT INTO users ( name, email) VALUES (:name,:email)");
    $insert->bindParam(':name', $name);
    $insert->bindParam(':email', $email);
    $insert->execute();
}

if (isset($_GET['idDelete'])) {
    $id_TODELETE = $_GET['idDelete'];
    $delete = $pdo->prepare("DELETE FROM users WHERE id=" . $id_TODELETE);
    $delete->execute();
}

if (isset($_GET['idModify'])) {
    $id_TOmodif = $_GET['idModify'];
    $req = "SELECT * FROM `users` WHERE id=" . $id_TOmodif;
    $res = $pdo->prepare($req);
    $res->execute();
    $currentUser = $res->fetchAll();
    $user_name=$currentUser[0]['name'];
    $user_email=$currentUser[0]['email'];
}




$request = $pdo->prepare("select * from users");
$request->execute();
$users = $request->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>

<head>
    <title>USERS</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <h1>Liste des utilisateurs</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr><td>" . $user->id . "</td><td>" . $user->name . "</td><td>" . $user->email . "</td>";
            echo '<td><a href="index.php?idDelete=' . $user->id . '">Supprimer</a></td>';
            echo '<td><a href="index.php?idModify=' . $user->id . '">Modifier</a></td></tr>';
        }
        ?>
    </table>
    <h2>Ajouter un utilisateur :</h2>
    <form id="add_user" action="" method="POST">
        <table>
            <tr>
                <th>Nom :</th>
                <td><input type="text" name="name_user"></td>
            </tr>
            <tr>
                <th>Mot de passe :</th>
                <td><input type="text" name="email_user"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="Ajouter Utilisateur" /></td>
            </tr>
        </table>
    </form>

    <h2>Modifier un utilisateur :</h2>
    <form id="modify_user" action="" method="GET">
        <table>
            <tr>
                <th>Nom :</th>
                <td><input type="text" name="new_name_user"></td>
            </tr>
            <tr>
                <th>Mot de passe :</th>
                <td><input type="text" name="new_email_user"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="Modifier Utilisateur" /></td>
            </tr>
        </table>
    </form>

    <?php
    $pdo = NULL;

    ?>

</body>

</html>