<?php
	$msg = "";

	if (isset($_POST['submit'])) {

		$con = new mysqli('localhost', 'root', '', 'asset');	

		$username = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);
		$cPassword = $con->real_escape_string($_POST['cPassword']);

		

		if ($password != $cPassword)
			$msg = "Please Check Your Passwords!";
		else {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$con->query("INSERT INTO users (username,email,password) SELECT * FROM (SELECT '$username', '$email', '$hash') AS tmp WHERE NOT EXISTS ( SELECT email FROM users WHERE email = '$email' ) LIMIT 1;");
			//INSERT INTO users (username,email,password) SELECT * FROM (SELECT '$username', '$email', '$hash') AS tmp WHERE NOT EXISTS ( SELECT email FROM users WHERE email = '$email' ) LIMIT 1;
			$msg = "You Are Already Registered!";

			
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<!-- <img src="asset.png"><br><br> -->
				<a href="Register.php"><i class="fab fa-accusoft fa-7x"></i></a>

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>

				<form method="post" action="register.php">
					<input class="form-control" minlength="3" name="name" placeholder="Name..."><br>
					<input class="form-control" name="email" type="email" placeholder="Email..."><br>
					<input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
					<input class="form-control" minlength="5" name="cPassword" type="password" placeholder="Confirm Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Register">
					<input class="btn btn-primary" type="button" onClick="location.href='Login.php'" value="Log In" ><br>
				</form><br>
				<!-- <a href="Login.php" class="btn btn-secondary">Click Here To Login!</a> -->

			</div>
		</div>
	</div>
</body>
</html>