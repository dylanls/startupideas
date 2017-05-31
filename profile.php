<?php
  session_start();
	include("config.php");

  //TODO change so profile is loaded by POST


?>

<html>
	<head>
		<title>Edit User Profile</title>
		<link rel="stylesheet" href="style.css">
	</head>
  <body>
    <h1> THIS PAGE IS UNDER CONSTRUCTION </h1>
    <h2>Your username is <?php echo $_SESSION['login_username']; ?> </h2>
    <a href="index.php"> Back to home </a>
  </body>
</html>
