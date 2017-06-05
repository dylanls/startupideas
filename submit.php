<?php
  session_start();
  include("config.php");
  if(!isset($_SESSION['login_username']) || !isset($_SESSION['login_userid'])) exit();
                                                                               
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userID = $_SESSION['login_userid'];
    $submittedIndustry = mysqli_real_escape_string($db, $_POST['industry']);
    $submittedPitch = mysqli_real_escape_string($db, $_POST['pitch']);
    //TODO CHECK FOR LOGIN


    $query = 'INSERT INTO pitches (user, industry, pitch, date) VALUES (' . $userID . ', "' . $submittedIndustry .  '", "' . $submittedPitch .  '", ' . 'NOW() );';
    //TODO change to time and date

    $result = mysqli_query($db, $query);
  }
  header('Location: index.php');

  ?>
