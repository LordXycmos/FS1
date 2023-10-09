<?php

include_once 'dbconnection.php';

$id1 = $_POST['band'];
$id2 = $_POST['event'];


$sql1 = "SELECT * FROM `band` WHERE `id` = '$id1'";
$result1 = mysqli_query($conn, $sql1);
$result1Check = mysqli_num_rows($result1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = "SELECT * FROM `event` WHERE `id` = '$id2'";
$result2 = mysqli_query($conn, $sql2);
$result2Check = mysqli_num_rows($result2);
$row2 = mysqli_fetch_assoc($result2);

if ($result1Check > 0 && $result2Check){
  $eventname = $row2['eventname'];
  $eventtime = $row2['eventtime'];
  $eventprice = $row2['eventprice'];
  $bandname = $row1['bandname'];
  $eventday = $row2['eventday'];
  $eventmonth = $row2['eventmonth'];
  $eventyear = $row2['eventyear'];

  $stmt = $conn->prepare("INSERT INTO connected(eventtime, bandname, eventprice, eventname, eventday, eventmonth, eventyear)
  values(?,?,?,?,?,?,?)");
  $stmt->bind_param("ssisiii", $eventtime, $bandname, $eventprice, $eventname, $eventday, $eventmonth, $eventyear);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}
header("location: admin.php");
exit();

?>