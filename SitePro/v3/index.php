<?php
$currentLang = 'fr';
$currentPageId = 'accueil';

if (isset($_GET['page'])) {
  $currentPageId = $_GET['page'];
}

if (isset($_GET['lang'])) {
  $currentLang = $_GET['lang'];
}

require_once($currentLang . "/template_header.php");
?>


<body>

    <header class="bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <h1>Nael Melikechi</h1>
        </div>
      </div>

    </header>
    <?php $mylang = array(
      'fr' => array('Français'),
      'en' => array('English')
    );


    echo '<nav class="nav nav-pills nav-fill"><div class="nav flex-row nav-pills">';
    foreach ($mylang as $langID => $langParameters) {
      $AffichageLang = $langParameters[0];
      if ($currentLang == $langID) {
        $activeLang = "active";
      } else {
        $activeLang = "";
      }
      echo '<a href="index.php?page=' . $currentPageId . '&lang=' . $langID . '" class="nav-link ' . $activeLang . '">' . $AffichageLang . '</a>';

    }
    echo '</div></nav>';

    ?>
  <div class="text-right  mr-5 pr-3">
    <img src="files/images/avatar.jpg" alt="avatar" class="img-thumbnail" style="max-width:8%">
  </div>



  <div class="container">
    <div class="row">
      <div class="col-auto shrink  bg-light">
        <?php
        require_once($currentLang . "/template_menu.php");
        renderMenuToHTML($currentPageId, $currentLang);
        ?>
      </div>
      <div class="col grow">
        <?php
        $pageToInclude = $currentLang . "/" . $currentPageId . ".php";
        if (is_readable($pageToInclude))
          require_once($pageToInclude);
        else
          require_once("error.php");
        ?>
      </div>
    </div>
  </div>
  <?php require_once($currentLang . "/template_footer.php"); ?>