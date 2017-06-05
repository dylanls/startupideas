<?php
  session_start();
  include("config.php");
  if(!isset($_REQUEST["id"]) || !isset($_SESSION['login_username'])) {
    exit();
  }
  $postid = mysqli_real_escape_string($db, $_REQUEST["id"]);

  $query = 'UPDATE pitches SET score = score + 1 WHERE postid =' . $postid . ';';
  $res = mysqli_query($db, $query);

  $query = 'SELECT score FROM pitches WHERE postid =' . $postid . ';';
  $res = mysqli_query($db, $query);
  $pitches = mysqli_fetch_assoc($res);

  echo $pitches['score'];

 ?>
