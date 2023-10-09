<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('location:login.php');
}

  include_once 'dbconnection.php';

  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $delete=mysqli_query($conn, "DELETE FROM `connected` WHERE `id` = '$id'");
    header("location:admin.php");
  };

  $sql = "SELECT * FROM connected;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <title>Casus Cafe Admin</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <a href="home.php" class="header-button">home</a>
    </header>
    <div class="main-content">
      <div class="button-menu">
        <a href="bands.php" class="menu-button">bands</a>
        <a href="events.php" class="menu-button">events</a>
        <a href="connect.php" class="menu-button">connect</a>
      </div>
      <?php 
      if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo "<article class='post'><a href='admin.php?id=".$row['id']."' class='post-delete-button'>x</a><p class='post-information'>". $row['eventtime']. " | ". $row['bandname'] . " | €" . $row['eventprice'] . " | " . $row['eventname'] . " | " . $row['eventday']. "-". $row['eventmonth'] . "-" . $row['eventyear'] ."</p></article>";
        }
      } else {
        echo "<article class='post'><p class='post-information'>can't find any upcoming events :(</p></article>";
      }
      ?>
    </div>
  </body>
</html>
