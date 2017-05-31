<?php
  session_start();
  include("config.php");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $submittedUsername = mysqli_real_escape_string($db, $_POST['username']);
      $submittedPassword = mysqli_real_escape_string($db, $_POST['password']);
      $submittedEmail = mysqli_real_escape_string($db, $_POST['email']);
      $submittedDOB = mysqli_real_escape_string($db, $_POST['dateofbirth']);
      $submittedDisplayname = mysqli_real_escape_string($db, $_POST['displayname']);

      //encryption for password
      //prepend salt to pwd
      $hash = password_hash($submittedPassword,  PASSWORD_DEFAULT);


      $query = 'INSERT INTO users (username, displayname, dob, email, pwdhash) VALUES ("' . $submittedUsername . '", "' . $submittedDisplayname .  '", "' . $submittedDOB .  '", "' . $submittedEmail . '", "' . $hash . '");';
      $result = mysqli_query($db, $query);

      $_SESSION['login_username'] = $submittedUsername;
      $query = 'SELECT userid FROM users WHERE username = "' . $submittedUsername . '";';
  		$uid = mysqli_fetch_assoc(mysqli_query($db, $query));
      $_SESSION['login_userid'] = $uid['userid'];

      header('Location: index.php');
  }
?>
