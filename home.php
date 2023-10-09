<?php 
session_start();
include_once "dbconnection.php";

$sql = "SELECT * FROM connected;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$jsdata = array();

while($row = mysqli_fetch_assoc($result)){
  $jsdata[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <title>Casus Cafe</title>
  </head>
  <body>
    <header>
      <h1 class="header-title">Casus Cafe</h1>
      <?php
        if (!isset($_SESSION['username'])) {
          echo "<a href='login.php' class='header-button'>login</a>";
        } else {
          echo "<a href='admin.php' class='header-button'>admin</a>";
        }
      ?>
    </header>
    <div class="main-content">
    <div class="button-menu">
      <button type="button" id="delbtn" class="menu-button"><</button>
      <h7 id='displayedmonth' class='selected-date'>0</h7>
      <button type="button" id="addbtn" class="menu-button">></button>
    </div>
    <div id="posts-test">
      <article class='full-post'><p class='top-post'>25th | 18:00 | Rock Night | €10</p><p class="bottom-post">BABYMETAL | HONNE | Imagine Dragons</p></article>
      <article class="post">
        <p>there's an error</p>
      </article>
      <article class="post">
        <p>a</p>
      </article>
      </div>
    </div>
  </body>
</html>

<script>
var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
const today = new Date();
let month = today.getMonth();
let year = today.getFullYear();

document.getElementById('displayedmonth').innerHTML = months[month] + " " + year;

document.getElementById('addbtn').addEventListener('click', function() {
  month++;
  if(month >= 12){
  month = 0;
  year++;
  }
  refreshevents();
  document.getElementById('displayedmonth').innerHTML = months[month] + " " + year;   
});
document.getElementById('delbtn').addEventListener('click', function() {
  month--;
  if(month < 0){
  month = 11;
  year--;
  }
  refreshevents();
  document.getElementById('displayedmonth').innerHTML = months[month] + " " + year;   
  });

function sortByDay(a,b){
  if(a.eventday < b.eventday){
    return -1;
  }
  if(a.eventday > b.eventday){
    return 1;
  }
}

function refreshevents(){
  var indexyear = 0;
  var indexmonth = 0;
  var text = "";
  var dbdata = <?= json_encode($jsdata)?>;
  var curyear = year;
  var curmonth = month + 1;
  var events = [];

  indexyear = dbdata.filter(item => item.eventyear.indexOf(curyear.toString()) !== -1);
  indexmonth = indexyear.filter(item => item.eventmonth.indexOf(curmonth.toString()) !== -1);
  indexmonth.sort(sortByDay);

  if(indexmonth.length !== 0){
    for (var i = 0; i < indexmonth.length; i++){
      var indexday = 0;
      var dayth = "th";
      var playingbands = "";
      var firstband = true;
      if(!events.includes(indexmonth[i].eventname)){
        indexday = indexmonth.filter(item => item.eventname.indexOf(indexmonth[i].eventname) !== -1);
        events.push(indexmonth[i].eventname);
        for(var a = 0; a < indexday.length; a++){
          if(firstband){
            playingbands = indexday[a].bandname;
            firstband = false;
          } else {
            playingbands += " | " + indexday[a].bandname;
          }
        }
        if(indexmonth[i].eventday == "1"){
          dayth = "st";
        } else if(indexmonth[i].eventday == "2"){
          dayth = "nd";
        } else if(indexmonth[i].eventday == "3"){
          dayth = "rd";
        }
        text += "<article class='full-post'><p class='top-post'>" + indexmonth[i].eventday + dayth + " | " + indexmonth[i].eventtime + " | " + indexmonth[i].eventname + " | €" + indexmonth[i].eventprice + "</p><p class='bottom-post'>" + playingbands + "</p></article>";
      }
    }
  } else {
    text = "<article class='full-post'>We couldn't find any events for this month :(</article>";
  }

  document.getElementById('posts-test').innerHTML = text;
}

refreshevents();
</script>
