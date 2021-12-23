<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$con = mysqli_connect("localhost","root","","asset");
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['Asset_No'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $Asset_No = isset($_POST['Asset_No']) ? $_POST['Asset_No'] : '';
        $Dated = isset($_POST['Dated']) ? $_POST['Dated'] : '';
        $Fault = isset($_POST['Fault']) ? $_POST['Fault'] : '';
        $RepairedBy = isset($_POST['RepairedBy']) ? $_POST['RepairedBy'] : '';
        $Repaired = isset($_POST['Repaired']) ? $_POST['Repaired'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE hardware SET Asset_No = ?, Dated = ?, Fault = ?, RepairedBy = ?, Repaired = ? WHERE Asset_No = ?');
        $stmt->execute([$Asset_No, $Dated, $Fault, $RepairedBy, $Repaired, $_GET['Asset_No']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM hardware WHERE Asset_No = ?');
    $stmt->execute([$_GET['Asset_No']]);
    $hardwares = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$hardwares) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');

        $sql = "UPDATE laptops SET Faulty='Faulty' WHERE $Asset_No = Asset_No AND $Repaired = 'No'";

    if (mysqli_query($con, $sql)) {
        $msg = "New Application Added Successfully";
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

<?=template_header('Update Faults')?>

<div class="content update">
	<h2>Update Fault <?=$hardwares['Asset_No']?></h2>
    <form action="update-faults.php?Asset_No=<?=$hardwares['Asset_No']?>" method="post">
        <label>Asset_No</label><input type="Asset_No" name="Asset_No" value="<?=$hardwares['Asset_No']?>" id="Asset_No" readonly>
        <label>Date Logged</label><input type="Dated" name="Dated" value="<?=$hardwares['Dated']?>" id="Dated" readonly>
        <label>Fault</label>   
        <select name="Fault">
        <option <?php if($hardwares['Fault']=="Keyboard") echo "selected"; ?> value="Keyboard">Keyboard</option>
        <option <?php if($hardwares['Fault']=="Screen") echo "selected"; ?> value="Screen">Screen</option>
        <option <?php if($hardwares['Fault']=="USB") echo "selected"; ?> value="USB">USB</option>
        <option <?php if($hardwares['Fault']=="TrackPad") echo "selected"; ?> value="TrackPad">TrackPad</option>
        <option <?php if($hardwares['Fault']=="Battery") echo "selected"; ?> value="Battery">Battery</option>
        <option <?php if($hardwares['Fault']=="Harddrive") echo "selected"; ?> value="Harddrive">Harddrive</option>
        <option <?php if($hardwares['Fault']=="Charger Port") echo "selected"; ?> value="Charger Port">Charger Port</option>
        <option <?php if($hardwares['Fault']=="RAM") echo "selected"; ?> value="RAM">RAM</option>
        </select>
        <label>RepairedBy</label><input type="RepairedBy" name="RepairedBy" value="<?=$hardwares['RepairedBy']?>" id="RepairedBy" >
        <label>Repaired</label>    
        <select name="Repaired">
        <option <?php if($hardwares['Repaired']=="") echo "selected"; ?> value=""></option>
        <option <?php if($hardwares['Repaired']=="Yes") echo "selected"; ?> value="Yes">Yes</option>
        <option <?php if($hardwares['Repaired']=="No") echo "selected"; ?> value="No">No</option>
        </select>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>