<?php 
function renderMenuToHTML($currentPage){
    echo "<div class='conteneur-flex ligne'>";
    $mymenu = array(
        'index'=>array('Accueil'),
        'aliments' => array('Renseignements Aliments'),
        'journal' =>  array('Journal') ,
        'dashboard' => array('Dashboard'),
    );
    
    foreach ($mymenu as $pageId => $pageParameters){
        echo "<div class='element-flex'>";
        if ($pageId==$currentPage){
            echo "<a href='index.php?page=$pageId' id=current>";
            echo $pageParameters[0];
            echo "</a></div>";
        }
        else {
           echo "<a href='index.php?page=$pageId'>";
           echo $pageParameters[0];
           echo "</a></div>";
        }
    }
   echo "</div>";
}
?>