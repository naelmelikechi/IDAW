<?php require_once('template_header.php');?>

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

        <nav class="nav nav-pills nav-fill">
          <div class="nav flex-column nav-pills">
            <a href="index.php" class="nav-link">Accueil</a>
            <a href="cv.php" class="nav-link active">CV</a>
            <a href="projets.php" class="nav-link">Projets</a>

          </div>
        </nav>
      </div>
      <div class="col grow">
        <article>
          <h2>Voici mon CV</h2>
          <p>Retrouvez-moi sur <a href="https://www.linkedin.com/in/naelmelikechi">LinkedIn</a>.</p>
        </article>
      </div>
    </div>
  </div>

  <?php require_once('template_footer.php');?>
