<?php
session_start();

	$msg = "";

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'asset');

		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);

		$sql = $con->query("SELECT id, password FROM users WHERE email='$email'");
		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password'])) {
		        $msg = "You have been logged IN!";
				header('Location: home.php');
            } else
			    $msg = "Please check your credentials!";
        } else
            $msg = "Please check your credentials!";
			$_SESSION["user"] = $email;

			echo $_SESSION["user"];
	}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
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
				<a href="Login.php"><i class="fab fa-accusoft fa-7x"></i></a>

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>
				<br><br><br>
				<form method="post" action="login.php">
					<input class="form-control" name="email" type="email" placeholder="Email..."><br>
					<input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Log In">
					<input class="btn btn-primary" type="button" onClick="location.href='Register.php'" value="Register" ><br>
				</form><br><br>
				<!-- <a href="Register.php" class="btn btn-secondary">Click Here To Register!</a><br><br> -->
				<a href="forgotten.php" class="btn btn-secondary">Click Here To Reset Password!</a>


			</div>
		</div>
	</div>
</body>
</html>