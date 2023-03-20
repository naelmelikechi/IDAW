<?php
$delete=file_get_contents('deleteDB.sql');
$requestDELETE=$pdo->exec($delete);

$create=file_get_contents('createDB.sql');
$requestCREATE=$pdo->exec($create);

$insert=file_get_contents('insertDB.sql');
$requestINSERT=$pdo->exec($insert);
?>