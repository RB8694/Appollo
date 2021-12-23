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
if (isset($_POST['Asset_No'])) 
{
    $Asset_No = $_POST['Asset_No'];
    $Dated = $_POST['Dated'];
    $Fault = $_POST['Fault'];
    $RepairedBy = $_POST['RepairedBy'];
    $Repaired = $_POST['Repaired'];

    $sql = "INSERT INTO hardware (Asset_No, Dated, Fault, RepairedBy, Repaired) VALUES ('$Asset_No', '$Dated', '$Fault', '$RepairedBy', '$Repaired')";
    $sql2 = "SET @faulty := 'Faulty'"; 
    $sql3 = "SET @faulty2 := 'No'"; 
    $sql4 = "SET @laptop := '$Asset_No'";
    $sql6 = "SET @repaired := '$Repaired'";
    $sql7 = "SELECT @laptop2 := Asset_No from laptops2 WHERE laptops2.Fault = @faulty";
    $sql5 = "UPDATE laptops2 SET laptops2.Faulty = @faulty WHERE laptops2.Asset_No = @laptop AND @repaired = @faulty2";



    if (mysqli_query($con, $sql)) {
        $msg = "New Fault Logged Successfully";
    } else {
	    $msg = "Error Adding New Application";
    }
    if (mysqli_query($con, $sql2)) {
        $msg = "New Fault Logged Successfully";
    } else {
	    $msg = "Error Adding New Application";
    }
    if (mysqli_query($con, $sql3)) {
        $msg = "New Fault Logged Successfully";
    } else {
	    $msg = "Error Adding New Application";
    }
    if (mysqli_query($con, $sql4)) {
        $msg = "New Fault Logged Successfully";
    } else {
	    $msg = "Error Adding New Application";
    }
    if (mysqli_query($con, $sql6)) {
        $msg = "New Fault Logged Successfully";
    } else {
	    $msg = "Error Adding New Application";
    }
    if (mysqli_query($con, $sql5)) {
        $msg = "New Fault Logged Successfully";
    } else {
	    $msg = "Error Adding New Application";
    }
    mysqli_close($con);
}
?>

<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Read')?>

<div class="content update">
	<h2>Log Fault</h2>
    <form action="create-fault.php" method="post">
        <label>Asset No</label><input type="Asset No" name="Asset No" id="Asset No" style="text-transform:uppercase">
        <label>Dated</label><input type="Date" name="Dated" id="Dated">

        <label>Fault</label><br><br>
        <select name="Fault" id="table" >
        <option value="Keyboard">Keyboard</option>
        <option value="Screen">Screen</option>
        <option value="USB">USB</option>
        <option value="TrackPad">TrackPad</option>
        <option value="Battery">Battery</option>
        <option value="Harddrive">Harddrive</option>
        <option value="Charger Port">Charger Port</option>
        <option value="RAM">RAM</option>
        </select>

        <label>RepairedBy</label>
        <select name="RepairedBy" id="table" >
        <option value="HP">HP</option>
        <option value="NEC">NEC</option>
        </select>

        <label>Repaired</label>
        <select name="Repaired" id="table" >
        <option value=""></option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>

        <input type="submit" value="Insert">
    </form>
    <?php if ($msg): 
    
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>