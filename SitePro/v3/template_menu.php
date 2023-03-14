<?php
function renderMenuToHTML($currentPageId)
{
    // un tableau qui definit la structure du site
    $mymenu = array(
        // idPage titre
        'accueil' => array('Accueil'),
        'cv' => array('CV'),
        'projets' => array('Projets')
    );
    echo '<nav class="nav nav-pills nav-fill"><div class="nav flex-column nav-pills">';
    foreach ($mymenu as $pageId => $pageParameters) {
        $title = $pageParameters[0];
        if ($currentPageId == $pageId) {
            $activeClass = "active";
        } else {
            $activeClass = "";
        }
        echo '<a href="index.php?page='.$pageId.'" class="nav-link ' . $activeClass . '">' . $title . '</a>';
    
    }
    echo '</div></nav>';
}
?>