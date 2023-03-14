<?php
require_once("template_header.php");

$currentPageId = 'accueil';
if (isset($_GET['page'])) {
  $currentPageId = $_GET['page'];
}
?>

<body>
  <header class="bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <h1>Nael Melikechi</h1>
      </div>
    </div>

  </header>
  <div class="text-right  mr-5 pr-3">
    <img src="files/images/avatar.jpg" alt="avatar" class="img-thumbnail" style="max-width:5%">
  </div>


  <div class="container">
    <div class="row">
      <div class="col-3">
        <?php
        require_once("template_menu.php");
        renderMenuToHTML($currentPageId);
        ?>
      </div>
      <div class="col grow">
        <?php
        $pageToInclude = $currentPageId . ".php";
        if (is_readable($pageToInclude))
          require_once($pageToInclude);
        else
          require_once("error.php");
        ?>
      </div>
    </div>
  </div>
  <?php require_once('template_footer.php'); ?>