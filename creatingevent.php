<?php

include_once 'dbconnection.php';

$eventname = $_POST['eventname'];
$eventtime = $_POST['eventtime'];
$eventprice = $_POST['eventprice'];
$eventday = $_POST['eventday'];
$eventmonth = $_POST['eventmonth'];
$eventyear = $_POST['eventyear'];

if($conn->connect_error){
  die('Connection Failed : '.$conn->connect_error);
}else{
  $stmt = $conn->prepare("insert into event(eventname, eventtime, eventprice, eventday, eventmonth, eventyear)
  values(?,?,?,?,?,?)");
  $stmt->bind_param("ssiiii",$eventname,$eventtime,$eventprice,$eventday,$eventmonth,$eventyear);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}
header("Location: events.php");
exit();
?>