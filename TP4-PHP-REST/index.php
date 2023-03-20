<!DOCTYPE html>
<html>

<head>
    <title>USERS</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

    <?php
    require_once('config.php');
    $connectionString = "mysql:host=" . _MYSQL_HOST;
    if (defined('_MYSQL_PORT'))
        $connectionString .= ";port=" . _MYSQL_PORT;
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $erreur) {
        myLog('Erreur : ' . $erreur->getMessage());
    }
    $request = $pdo->prepare("select * from users");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);

    echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    foreach ($users as $user) {
        echo "<tr><td>" . $user->id . "</td><td>" . $user->name . "</td><td>" . $user->email . "</td></tr>";
    }
    echo "</table>";

    $pdo = null;

    ?>

</body>

</html>