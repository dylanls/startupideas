<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'social');
   define('DB_PASSWORD', 'padua');
   define('DB_DATABASE', 'SOCIAL');
   $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
   if(mysqli_connect_errno()) {
	echo "SQL CONNECTION FAILED" . mysqli_connect_error();	
	exit();	
	}
	
	

?>
