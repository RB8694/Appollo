<?php
include 'functions.php';
//$pdo = pdo_connect_mysql();
$server = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$db = 'asset';

$con = mysqli_connect($server, $dbuser, $dbpassword, $db);

$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_POST['CR_No'])) 
{
    $CR_No = $_POST['CR_No'];
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Dated = $_POST['Dated'];


    $sql = "INSERT INTO leavers (CR_No, Name, Email, Dated) VALUES ('$CR_No', '$Name', '$Email', '$Dated')";
    $sql2 = "DELETE FROM bexstaff WHERE Email = '$Email'";
    $sql5 = "SET @user2 := ' '"; 
    $sql6 = "SET @user := '$Name'"; 
    $sql7 = "SELECT @laptop := Asset_No from laptops WHERE laptops.User = @user"; 
    $sql8 = "UPDATE laptops SET laptops.User = @user2 WHERE laptops.Asset_No = @laptop";

    if (mysqli_query($con, $sql2)) {
        $msg = "Successfully Removed From Bexley Staff";
    } else {
	    $msg = "Successfully Added Leaver";
    }

    if (mysqli_query($con, $sql5)) {
        $msg = "New thing Successfully";
    } else {
	    $msg = "Error Adding New Starter";
    }
    if (mysqli_query($con, $sql6)) {
        $msg = "New thing Successfully";
    } else {
	    $msg = "Error Adding New Starter";
    }
    if (mysqli_query($con, $sql7)) {
        $msg = "New thing Successfully";
    } else {
	    $msg = "Error Adding New Starter";
    }
    if (mysqli_query($con, $sql8)) {
        $msg = "New thing Successfully";
    } else {
	    $msg = "Error Adding New Starter";
    }

    if (mysqli_query($con, $sql)) {
        $msg = "Successfully Added Leaver";
    } else {
	    $msg = "Successfully Added Leaver";
    }
    mysqli_close($con);
}

       
    //$sql4 = "SET @user := 'Rob Blank'; SELECT Asset_No from laptops2 WHERE laptops2.User = @user; UPDATE laptops2 SET User = '' WHERE User = @user;"
    //$sql3 = "SET @laptop := 'LBBL0011'; SET @user := ' '; UPDATE laptops2 SET User = @user WHERE Asset_No = @laptop;"

    


?>

<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Read')?>

<div class="content update">
	<h2>Create Leaver</h2>
    <form action="create-leaver.php" method="post">
        <label>CR_No</label><input type="CR" name="CR_No" id="CR_No" style="text-transform:uppercase">
        <label>Name</label><input type="Name" name="Name" id="Name">
        <label>Email</label><input type="Email" name="Email" id="Email">
        <label>Dated</label><input type="Date" name="Dated" id="Dated">
        
        <input type="submit" value="Insert">
    </form>
    <?php if ($msg): 
    //header('Location: software.php');
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>