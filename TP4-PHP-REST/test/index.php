<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <?php
        $url = "http://localhost/api.php";
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        echo "<ul>";
        foreach ($data as $user) {
            echo "<li>" . $user['nom'] . " (" . $user['email'] . ")</li>";
        }
        echo "</ul>";
    ?>
</body>
</html>
