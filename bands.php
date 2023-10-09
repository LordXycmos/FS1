<!--------------------->
<!--      PHP        -->
<!--------------------->
<?php
  session_start();

  if (!isset($_SESSION['username'])) {
    header('location:login.php');
  }

  include_once 'dbconnection.php';

  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $delete=mysqli_query($conn, "DELETE FROM `band` WHERE `id` = '$id'");
    header("location:bands.php");
  };

  $sql = "SELECT * FROM band;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
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
    <title>Casus Cafe Admin - Bands</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <a href="home.php" class="header-button">home</a>
    </header>
    <div class="main-content">
      <div class="button-menu">
        <a href="admin.php" class="menu-button">back</a>
        <a href="createband.php" class="menu-button">create</a>
      </div>
      <?php 
      if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo "<article class='post'><a href='bands.php?id=".$row['id']."' class='post-delete-button'>x</a><p class='post-information'>". $row['bandname']. " | ". $row['bandgenre'] ."</p></article>";
        }
      } else {
        echo "<article class='post'><p class='post-information'>can't find any bands :(</p></article>";
      }
      ?>
    </div>
  </body>
</html>
