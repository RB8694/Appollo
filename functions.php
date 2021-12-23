<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'asset';

    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
        <link rel="icon" href="appollo.png" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
    
    <nav class="navtop">
    	<div class= "wrapper">
            <div class="Col-1">
                <img src="apollo_W10_Icon.ico" height="55px" width="55px"/>
            </div>
            <div class="Col-2">
                <h1>Appollo</h1>
            </div>
            <div class="Col-3">
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-laptop"></i>
                        Assets
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="laptops.php"><i class="fas fa-laptop"></i>Laptops</a>
                        <hr>
                        <a href="mobiles.php"><i class="fas fa-mobile-alt"></i>Mobiles</a>
                        <hr>
                        <a href="desktops.php"><i class="fas fa-desktop"></i>Desktops</a>
                        <hr>
                        <a href="libraries.php"><i class="fas fa-book-open"></i>Libraries</a>
                        <hr>
                        <a href="monitors.php"><i class="fas fa-laptop"></i>Monitors</a>
                        <hr>
                        <a href="datasim.php"><i class="fas fa-sim-card"></i>DataSims</a>
                        <!--<hr>-->
                        <!--<a href="nec.php"><i class="fas fa-laptop"></i>NEC</a>-->
                        <hr>
                        <a href="faults.php"><i class="fas fa-tools"></i>Faults</a>
                        <hr>
                        <a href="printers.php"><i class="fas fa-tools"></i>Printers</a>

                    </div>

                </div>
                
            <a href="software2.php"><i class="fas fa-terminal"></i>Software</a>
            
                
            <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-laptop"></i>
                        Users
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="newstarter.php"><i class="fas fa-user-alt"></i>New Starter</a>
                        <hr>
                        <a href="leaver.php"><i class="fas fa-user-alt-slash"></i>Leavers</a>
                        <hr>
                        <a href="bexleystaff.php"><i class="far fa-id-badge"></i>Bex Staff</a>
                    </div>

                </div>
                <a href="Logout.php"><i class="fas fa-times"></i>Logout</a>
            </div>
        </div>

    </nav>


    	
  
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>