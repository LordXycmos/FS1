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
    <title>Casus Cafe Admin - Create Event</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <a href="home.php" class="header-button">home</a>
    </header>
    <div class="main-content">
      <div class="button-menu">
        <a href="events.php" class="menu-button">back</a>
      </div>
      <form action="creatingevent.php" method="post">
        <article class="post">
          <div>
            <label class="form-name">event name:</label>
            <input class="form-input-text" name="eventname" />
          </div>
        </article>
        <article class="post">
          <div>
            <label class="form-name">event date:</label>
            <select class="form-input-text" name="eventday">
              <?php 
                for ($i = 1; $i <= 31; $i++){
                  echo "<option value='".$i."'>".$i."</option>";
                }
              ?>
            </select>
            <select class="form-input-text" name="eventmonth">
            <?php 
                for ($i = 1; $i <= 12; $i++){
                  echo "<option value='".$i."'>".$i."</option>";
                }
              ?>
            </select>
            <input class="form-input-text" type="text" name="eventyear" />
          </div>
        </article>
        <article class="post">
          <div>
            <label class="form-name">event time:</label>
            <input class="form-input-text" name="eventtime" />
          </div>
        </article>
        <article class="post">
          <div>
            <label class="form-name">event price:</label>
            <input class="form-input-text" name="eventprice" />
          </div>
        </article>
        <article class="post">
          <div>
            <input class="submit-button" type="submit" value="create event" />
          </div>
        </article>
      </form>
    </div>
  </body>
</html>
