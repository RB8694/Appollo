<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['Asset_No'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $Asset_No = isset($_POST['Asset_No']) ? $_POST['Asset_No'] : '';
        $Make = isset($_POST['Make']) ? $_POST['Make'] : '';
        $Model = isset($_POST['Model']) ? $_POST['Model'] : '';
        $Model_Number = isset($_POST['Model_Number']) ? $_POST['Model_Number'] : '';
        $Gmail = isset($_POST['Gmail']) ? $_POST['Gmail'] : '';
        $IMEI = isset($_POST['IMEI']) ? $_POST['IMEI'] : '';
        $Storage = isset($_POST['Storage']) ? $_POST['Storage'] : '';
        $Serial_Number = isset($_POST['Serial_Number']) ? $_POST['Serial_Number'] : '';
        $Mobile_Number = isset($_POST['Mobile_Number']) ? $_POST['Mobile_Number'] : '';
        $Notes = isset($_POST['Notes']) ? $_POST['Notes'] : '';
        $Location = isset($_POST['Location']) ? $_POST['Location'] : '';
        $User = isset($_POST['User']) ? $_POST['User'] : '';
        $Assigned = isset($_POST['Assigned']) ? $_POST['Assigned'] : '';
        $Decommissioned = isset($_POST['Decommissioned']) ? $_POST['Decommissioned'] : '';
        $History = isset($_POST['History']) ? $_POST['History'] : '';
        $NPS = isset($_POST['NPS']) ? $_POST['NPS'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE Mobiles SET Asset_No = ?, Make = ?, Model = ?, Model_Number = ?, Gmail = ?, IMEI = ?, Storage = ?, Serial_Number = ?, Mobile_Number = ?, Notes = ?, Location = ?, User = ?, Assigned = ?, Decommissioned = ?, History = ?, NPS = ? WHERE Asset_No = ?');
        $stmt->execute([$Asset_No, $Make, $Model, $Model_Number, $Gmail, $IMEI, $Storage, $Serial_Number, $Mobile_Number, $Notes, $Location, $User, $Assigned, $Decommissioned, $History, $NPS, $_GET['Asset_No']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM Mobiles WHERE Asset_No = ?');
    $stmt->execute([$_GET['Asset_No']]);
    $mobiles = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$mobiles) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Update Mobiles')?>

<div class="content update">
	<h2>Update Contact #<?=$mobiles['Asset_No']?></h2>
    <form action="update-mobiles.php?Asset_No=<?=$mobiles['Asset_No']?>" method="post">
        <label>Asset_No</label><input type="Asset_No" name="Asset_No" value="<?=$mobiles['Asset_No']?>" id="Asset_No" readonly>
        <label>Make</label><input type="Make" name="Make" value="<?=$mobiles['Make']?>" id="Make" readonly>
        <label>Model</label><input type="Model" name="Model" value="<?=$mobiles['Model']?>" id="Model" >
        <label>Model_Number</label><input type="Model_Number" name="Model_Number" value="<?=$mobiles['Model_Number']?>" id="Model_Number" >
        <label>Gmail</label><input type="Gmail" name="Gmail" value="<?=$mobiles['Gmail']?>" id="Gmail" readonly>
        <label>IMEI</label><input type="IMEI"  name="IMEI" value="<?=$mobiles['IMEI']?>" id="IMEI" >
        <label>Storage</label><input type="Storage"  name="Storage" value="<?=$mobiles['Storage']?>" id="Storage" >
        <label>Serial_Number</label><input type="Serial_Number"  name="Serial_Number" value="<?=$mobiles['Serial_Number']?>" id="Serial_Number" >
        <label>Mobile_Number</label><input type="Mobile_Number"  name="Mobile_Number" value="<?=$mobiles['Mobile_Number']?>" id="Mobile_Number" >
        <label>Notes</label><input type="Notes"  name="Notes" value="<?=$mobiles['Notes']?>" id="Notes" >
        <label>Location</label><input type="Location"  name="Location" value="<?=$mobiles['Location']?>" id="Location" >
        <label>User</label><input type="User"  name="User" value="<?=$mobiles['User']?>" id="User" >
        <label>Assigned</label><input type="Assigned"  name="Assigned" value="<?=$mobiles['Assigned']?>" id="Assigned" >
        <label>Decommissioned</label><input type="Decommissioned"  name="Decommissioned" value="<?=$mobiles['Decommissioned']?>" id="Decommissioned" >
        <label>History</label><input type="History"  name="History" value="<?=$mobiles['History']?>" id="History" >
        <label>NPS</label><input type="NPS"  name="NPS" value="<?=$mobiles['NPS']?>" id="NPS" >

        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>