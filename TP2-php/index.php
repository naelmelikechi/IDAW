<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>

<body>
    <h1>Heure actuelle :</h1>
    <p>
        <?php echo date('H:i:s');?>
    </p>
    <p>
        <?php
        echo date('d:m:Y');?>
    </p>
    <p>
        <?php
            $tab1 = array("A","B","C");
            $tab2[0] = "A";
            $tab2[1] = "B";
            $tab2[2] = "C";
            $tab3[] = "A";
            $tab3[] = "B";
            $tab3[] = "C";            
        ?>
    </p>
    <p>
        <?php
            function helloWorld($var1, $var2) {
                echo "Hello, World! var1 = " . $var1 . " var2 = " . $var2;
            }
            
            helloWorld("a","b");
        ?>

    </p>
</body>


</html>
