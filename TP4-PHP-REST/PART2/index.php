<?php
require_once('initPDO.php');
require_once('db_init.php');

if (isset($_POST['name']) && isset($_POST['email'])) {

    $insert = $pdo->prepare("INSERT INTO users ( name, email) VALUES (:name,:email)");
    $insert->bindParam(':name', $name);
    $insert->bindParam(':email', $email);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $insert->execute();
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
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr><td>" . $user->id . "</td><td>" . $user->name . "</td><td>" . $user->email . "</td></tr>";
        }
        ?>
    </table>
    <h2>Ajouter un utilisateur :</h2>
    <form id="add_user" action="" method="POST">
        <table>
            <tr>
                <th>Nom :</th>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <th>Mot de passe :</th>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="Ajouter Utilisateur" /></td>
            </tr>
        </table>
    </form>

    <?php
    $pdo = NULL;

    ?>

</body>

</html>