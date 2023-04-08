<?php 
function renderMenuToHTML($currentPage){
    echo "<div class='conteneur-flex ligne'>";
    $mymenu = array(
        'index' => array('Accueil', 'accueil.php'),
        'aliments' => array('Aliments', 'aliments.php'),
        'journal' =>  array('Profil', 'profil.php'), 
        'dashboard' => array('Dashboard', 'dashboard.php'),
    );
    
    foreach ($mymenu as $pageId => $pageParameters){
        echo "<div class='element-flex'>";
        if ($pageId==$currentPage){
            echo "<a href='{$pageParameters[1]}' id=current>";
            echo $pageParameters[0];
            echo "</a></div>";
        }
        else {
           echo "<a href='{$pageParameters[1]}'>";
           echo $pageParameters[0];
           echo "</a></div>";
        }
    }
   echo "</div>";
}
?>