<?php 
  session_start();

  if (!isset($_SESSION['username'])) {
    header('location:login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <title>Casus Cafe Admin - Create Band</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <a href="home.php" class="header-button">home</a>
    </header>
    <div class="main-content">
      <div class="button-menu">
        <a href="bands.php" class="menu-button">back</a>
      </div>
      <form action="creatingband.php" method="post">
        <article class="post">
          <div>
            <label class="form-name">band name:</label>
            <input class="form-input-text" type="text" name="bandname" />
          </div>
        </article>
        <article class="post">
          <div>
            <label class="form-name">band genre:</label>
            <input class="form-input-text" type="text" name="bandgenre" />
          </div>
        </article>
        <article class="post">
          <div>
            <input class="submit-button" type="submit" value="create band" />
          </div>
        </article>
      </form>
    </div>
  </body>
</html>
