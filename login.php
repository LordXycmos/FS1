<?php 
session_start();
include_once 'dbconnection.php';
$errormessage = "";
if(isset($_POST['submit'])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM `login` WHERE `username` = '$username' AND `password` = '$password'";
  $result = $conn->query($sql);
  $resultCheck = mysqli_num_rows($result);

  if ($resultCheck > 0){
    $_SESSION['username'] = $username;
    header("location:admin.php");
    die;
  }
  $errormessage = "incorrect username or password";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <title>Casus Cafe Admin - Login</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <a href="home.php" class="header-button">home</a>
    </header>
    <div class="main-content">
      <form method="post">
        <article class="post">
          <div>
            <label class="form-name">username:</label>
            <input class="form-input-text" type="text" name="username" />
          </div>
        </article>
        <article class="post">
          <div>
            <label class="form-name">password:</label>
            <input class="form-input-text" type="password" name="password" />
          </div>
        </article>
        <article class="post">
          <div>
            <input class="submit-button" type="submit" name="submit" value="login" />
          </div>
        </article>
        <?php echo "<p class='full-post'>" . $errormessage . "</p>" ?>
      </form>
    </div>
  </body>
</html>
