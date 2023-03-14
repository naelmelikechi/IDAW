<?php require_once('template_header.php'); ?>

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
          require_once('template_menu.php');
          renderMenuToHTML('projets');
        ?>
      </div>

      <div class="col grow">
        <article>
          <h2>Voici les differents projets que j'ai réalisé</h2>
          <p>Voici mon lien <a href="https://github.com/naelmelikechi">GitHub</a>.</p>
        </article>
      </div>
    </div>
  </div>
  <?php require_once('template_footer.php'); ?>