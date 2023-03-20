<!DOCTYPE html>
<html>

<head>
    <title>USERS</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

    <h1>Tableau des utilisateurs de la base de données</h1>
    <?php

    require_once('initPDO.php');
    require_once('db_init.php');

    $request = $pdo->prepare("select * from users");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);

    echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    foreach ($users as $user) {
        echo "<tr><td>" . $user->id . "</td><td>" . $user->name . "</td><td>" . $user->email . "</td></tr>";
    }
    echo "</table>";

    

    ?>

    <form action="index.php" method="POST">
        <label for="nom">Name :</label>
        <input type="text" id="nom" name="nom" required>
        <label for="nom">Email :</label>
        <input type="text" id="nom" name="nom" required>
        <input type="submit" value="Ajouter">
    </form>

    <?php
    $sql = "INSERT INTO users (name, email) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['nom']  , $_POST['email']]);
    
    $pdo = null;
    ?>

</body>

</html>