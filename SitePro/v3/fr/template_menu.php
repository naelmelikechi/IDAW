<?php
function renderMenuToHTML($currentPageId, $currentLang)
{
    // un tableau qui definit la structure du site
    $mymenu = array(
        // idPage titre
        'accueil' => array('Accueil'),
        'cv' => array('CV'),
        'projets' => array('Projets'),
        'contact' => array('Contact')
    );
    echo '<nav class="nav nav-pills nav-fill"><div class="nav flex-column nav-pills">';
    foreach ($mymenu as $pageId => $pageParameters) {
        $title = $pageParameters[0];
        if ($currentPageId == $pageId) {
            $activeClass = "active";
        } else {
            $activeClass = "";
        }
        echo '<a href="index.php?page='.$pageId.'&lang='.$currentLang.'" class="nav-link ' . $activeClass . '">' . $title . '</a>';
    
    }
    echo '</div></nav>';
}
?>