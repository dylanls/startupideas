<?php
	session_start();
	include("config.php");


	function loggedin() {
		if(!isset($_SESSION['login_username']))
			return 0;
		else
			return 1;
	}
	//verify login session
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$_SESSION['login_error'] = " ";
		//username and pwd sent
		$curUserName = mysqli_real_escape_string($db, $_POST['username']);
		$curPassword = mysqli_real_escape_string($db, $_POST['password']);

		//todo: add email login support
		$query = 'SELECT userid FROM users WHERE username = "' . $curUserName . '";';
		$uid = mysqli_fetch_assoc(mysqli_query($db, $query));

		$query = 'SELECT pwdhash FROM users WHERE username = "' . $curUserName . '";';

		$result = mysqli_query($db, $query);
		$count = mysqli_num_rows($result);

		$hash = mysqli_fetch_assoc($result);

		if(($count == 1) && password_verify($curPassword, $hash['pwdhash'])) {
			//there is one user with said login, so we can assume you are it
			$_SESSION['login_username'] = $curUserName;
			$_SESSION['login_userid'] = $uid['userid'];
		}
		else if ($query && !password_verify($curPassword, $hash['pwdhash'])) {
			$_SESSION['login_error'] = "Invalid Login name or Password";
			//TODO: add seperate cases for incorrect name or password

		}
		header('Location: index.php');
	}
?>
<html>
	<head>
		<title>Strtup - User ideas meet business experience - </title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="/material/material.min.css">
		<script src="/material/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
<body>
<style>
.demo-card-wide.mdl-card {
	width: 256px;
	height: 256px;
	background: #7a88a7;
}
.demo-card > .mdl-card__title {
	color: #fff;
	background: #2d2f3c;
	height: 150px;
}
.demo-title{
	font-size: 16px;
	font-family: 'Roboto';
}
.demo-name{
	font-size: 14px;
	font-family: 'Roboto';
	font-style: italic;
}
.demo-date{
	font-size: 12px;
	font-family: 'Roboto';

}
.demo-title-bold{
	font-size: 16px;
	font-weight: bold;
	font-family: 'Roboto';
}

.one {
    width: 256px;
    height: 256px;
		margin: 20px;
    float: left;
}
.two {
    width: 256%;
    height: 256px;


}
.thumbup { color: #87e37c; }
.thumbdown { color: #e37c7c; }
</style>

	<div class="mdl-card demo-card-wide mdl-shadow--4dp one" id="left">
			<div class="mdl-card__actions demo-card">
				<div class="mdl-card__title mdl-shadow--2dp">
		 		 <p class="demo-title">WE ARE DISRUPTING THE <span class="demo-title-bold">PLACEHOLDER</span> INDUSTRY BY <span class="demo-title-bold">PLACEHOLDING THIS CARD WHILE DYLAN LEARNS CSS</span></p>
		 	 	</div>
			</div>

			<div class="mdl-card__supporting-text demo-name">
    		By John Smith <span class="demo-date"> (2017-05-30 21:51:59) </span>
  		</div>
			<div class="mdl-card__actions mdl-card--border demo-card-wide" >
				<b class="demo-title">+250</b>
    		<button class="mdl-button thumbup mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-shadow--2dp">  <i class="material-icons">thumb_up</i></button>
				<button class="mdl-button thumbdown mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-shadow--2dp">  <i class="material-icons">thumb_down</i></button>
			</div>

 </div>
 <br>
 <div class="mdl-card demo-card-wide mdl-shadow--4dp two" id="right">
 		<div class="mdl-card__actions demo-card">
 			<div class="mdl-card__title mdl-shadow--2dp">
 			 <p class="demo-title">WE ARE DISRUPTING THE <span class="demo-title-bold">PLACEHOLDER</span> INDUSTRY BY <span class="demo-title-bold">PLACEHOLDING THIS CARD WHILE DYLAN LEARNS CSS</span></p>
 			</div>
 		</div>

 		<div class="mdl-card__supporting-text demo-name">
 			By John Smith <span class="demo-date"> (2017-05-30 21:51:59) </span>
 		</div>
 		<div class="mdl-card__actions mdl-card--border demo-card-wide" >
 			<b class="demo-title">+250</b>
 			<button class="mdl-button thumbup mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-shadow--2dp">  <i class="material-icons">thumb_up</i></button>
 			<button class="mdl-button thumbdown mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-shadow--2dp">  <i class="material-icons">thumb_down</i></button>
 		</div>

 </div>
<br>
	<script type="text/javascript">
			var displayLogin = true;
			//TODO: fix so this displays based on if a failed login or not
			var displayRegister = true;
			function showLogin() {
				document.getElementById('login').setAttribute('class', displayLogin ? 'visible' : 'hidden');
				displayLogin = !displayLogin;
			}
			function showRegister() {
				document.getElementById('register').setAttribute('class', displayRegister ? 'visible' : 'hidden');
				displayRegister = !displayRegister;
			}
	</script>
	<div id="visible_when_not_logged_in" class="visible">
		<a href="#" onclick="showLogin();"><h3>Login</h3> </a>
		<div id="login" class="hidden">
			<form method = "post" action = "index.php">

											<label>Username:</label> <input type = "text" name = "username" class = "box"/>
						<br />
											<label>Password:</label> <input type = "password" name = "password" class = "box" />
											<input type = "submit" value = "Login"/>
											<div style = "font-size:11px; color:#cc0000; margin-top:10px">  <?php echo $_SESSION['login_error']; ?> </div>
			</form>
		</div>
		<a href="#" onclick="showRegister();"><h3>Register</h3> </a>
		<div id="register" class="hidden">
			<script type="text/javascript">
				function verifyRegistration(form) {
					//probably something will go here eventually
				}
			</script>

			<form method = "post" action = "register.php" id="register" onsubmit="return verifyRegistration(this)">

											<label>Username:</label> <input type = "text" required name = "username" class = "box"/>
											<br>
											<label>Display Name:</label> <input type = "text" name = "displayname" class = "box"/>
											<br>
											<label>Email:</label> <input type = "email" name = "email" required placeholder="enter a valid email" class = "box"/>
											<br>
											<!-- <label>Date of Birth:</label> <input type = "date" name = "dateofbirth" class = "box"/>
											<br> -->
											<label>Password:</label> <input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" type = "password" name = "password" class = "box" onchange="
	  											this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
	  											if(this.checkValidity()) form.password_confirm.pattern = this.value;"/>
											<br>
											<label>Confirm Password:</label> <input title="Password must match above" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" type = "password" name = "password" class = "box" onchange="
			  									this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
											<input type = "submit" value = "Register"/>
			</form>
		</div>
	</div>

	<div class="hidden" id="visible_when_logged_in">
		<script type="text/javascript">
			function showSubmit() {
					document.getElementById('submit').setAttribute('class', 'visible');
			}
			function verifySubmission(sub){
					return true; //TODO
			}

		</script>
		<a href='profile.php' id="profile">Profile</a>
		<a href='logout.php' id="logout">Logout</a>
		<a href='#' onclick="showSubmit();">Submit Pitch</a>
		<div class="hidden" id="submit">
			<h3>Submit Startup Idea</h3>
			<form method = "post" id="submitform" action="submit.php" onsubmit="return verifySubmission(this)">
					<p>We are disrupting the <input type="text" name="industry" placeholder="compression" maxlength="25"> industry by <br> <input type="text" name="pitch" placeholder="shrinking everyone's files." size="60" maxlength="60"></p>

					<input type = "submit" value = "Submit"/>
			</form>

		</div>
	</div>
		<h3>User-Submitted Startup Ideas </h3>
		<?php
				//select * from pitches where user in(select user from pitches order by date) order by date desc;
				$query = 'SELECT * FROM pitches WHERE user IN(SELECT user FROM pitches ORDER BY date) ORDER BY date DESC;';
				$result = mysqli_query($db, $query);
				if (mysqli_num_rows($result) > 0) {
					while($pitches = mysqli_fetch_assoc($result)){
						$query = 'SELECT displayname from users WHERE userid = ' . $pitches["user"] . ';';
						$dispname = mysqli_fetch_assoc(mysqli_query($db, $query));
						echo "By " . $dispname['displayname'] . "<p>             We are disrupting the <b>" . $pitches["industry"]. "</b> industry by <b>" . $pitches["pitch"]. "</b>  </p>               <i>(" . $pitches[date] . ") </i><br> <hr> <br>";
					}
				}


		 ?>
	<script type="text/javascript">
		if(<?php echo loggedin(); ?>){
			//change visiblity of elements based on login state
			 document.getElementById('visible_when_not_logged_in').setAttribute('class', 'hidden');
			 document.getElementById('visible_when_logged_in').setAttribute('class', 'visible');

			 //TODO: add classes for logged in stuff and not logged in stuff

		}
	</script>


</body>
</html>
