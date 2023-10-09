<?php

include_once 'dbconnection.php';

$bandname = $_POST['bandname'];
$bandgenre = $_POST['bandgenre'];

// $conn = new mysqli('localhost', 'root', '', 'CasusCafe');
if($conn->connect_error){
  die('Connection Failed : '.$conn->connect_error);
}else{
  $stmt = $conn->prepare("insert into band(bandname, bandgenre)
  values(?,?)");
  $stmt->bind_param("ss",$bandname,$bandgenre);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}
header("Location: bands.php");
exit();
?>