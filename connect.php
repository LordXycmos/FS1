<!--------------------->
<!--      PHP        -->
<!--------------------->
<?php
  session_start();

  if (!isset($_SESSION['username'])) {
    header('location:login.php');
  }

  include_once 'dbconnection.php';

  $sql1 = "SELECT * FROM band;";
  $result1 = mysqli_query($conn, $sql1);
  $result1Check = mysqli_num_rows($result1);

  $sql2 = "SELECT * FROM event;";
  $result2 = mysqli_query($conn, $sql2);
  $result2Check = mysqli_num_rows($result2);
?>


<!--------------------->
<!--      HTML       -->
<!--------------------->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <title>Casus Cafe Admin - Connect</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <a href="home.php" class="header-button">home</a>
    </header>
    <div class="main-content">
      <div class="button-menu">
        <a href="admin.php" class="menu-button">back</a>
      </div>
      <form action="connecting.php" method="post">
      <article class="post">
        <div>
          <label class="form-name">band:</label>
          <select class="form-input-text" name="band">
            <option>-- select</option>
            <?php 
      if ($result1Check > 0){
        while ($row1 = mysqli_fetch_assoc($result1)){
          echo "<option value='" . $row1['id'] . "'>" . $row1['bandname'] ."</option>";
        }
      }
      ?>
          </select>
        </div>
      </article>
      <article class="post">
        <div>
          <label class="form-name">event:</label>
          <select class="form-input-text" name="event">
            <option>-- select</option>
            <?php 
      if ($result2Check > 0){
        while ($row2 = mysqli_fetch_assoc($result2)){
          echo "<option value='" . $row2['id'] . "'>" . $row2['eventname'] ."</option>";
        }
      }
      ?>
          </select>
        </div>
      </article>
      <article class="post">
        <div>
          <input class="submit-button" type="submit" value="connect" />
        </div>
      </article>
    </form>
    </div>
  </body>
</html>
