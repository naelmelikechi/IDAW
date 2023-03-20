<?php
require_once('initPDO.php');
require_once('db_init.php');

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
<?php
echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
foreach ($users as $user) {
    echo "<tr><td>" . $user->id . "</td><td>" . $user->name . "</td><td>" . $user->email . "</td></tr>";
}
echo "</table>";

$pdo = NULL;

?>

</body>

</html>