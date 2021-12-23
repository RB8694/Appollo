<?php
session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['Asset_No'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $Asset_No = isset($_POST['Asset_No']) ? $_POST['Asset_No'] : '';
        $Serial_Number = isset($_POST['Serial_Number']) ? $_POST['Serial_Number'] : '';
        $User = isset($_POST['User']) ? $_POST['User'] : '';
        $Date = isset($_POST['Date']) ? $_POST['Date'] : '';
        $Model = isset($_POST['Model']) ? $_POST['Model'] : '';
        $Assigned = isset($_POST['Assigned']) ? $_POST['Assigned'] : '';
        $NPS = isset($_POST['NPS']) ? $_POST['NPS'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE Monitors SET Asset_No = ?, Serial_Number = ?, User = ?, Date = ?, Model = ?, Assigned = ?, NPS = ? WHERE Asset_No = ?');
        $stmt->execute([$Asset_No, $Serial_Number, $User, $Date, $Model, $Assigned, $NPS, $_GET['Asset_No']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM Monitors WHERE Asset_No = ?');
    $stmt->execute([$_GET['Asset_No']]);
    $monitors = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$monitors) {
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

<?=template_header('Update Monitors')?>

<div class="content update">
	<h2>Update Contact #<?=$monitors['Asset_No']?></h2>
    <form action="update-monitors.php?Asset_No=<?=$monitors['Asset_No']?>" method="post">
        <label>Asset_No</label><input type="Asset_No" name="Asset_No" value="<?=$monitors['Asset_No']?>" id="Asset_No" readonly>
        <label>Serial Number</label><input type="Serial_Number" name="Serial_Number" value="<?=$monitors['Serial_Number']?>" id="Serial_Number" readonly>
        <label>User</label><input type="User" name="User" value="<?=$monitors['User']?>" id="User" >
        <label>Date</label><input type="Date" name="Date" value="<?=$monitors['Date']?>" id="Date" >
        <label>Model</label><input type="Model" name="Model" value="<?=$monitors['Model']?>" id="Model" readonly>
        <label>Assigned</label><input type="Assigned"  name="Assigned" value="<?=$monitors['Assigned']?>" id="Assigned" >
        <label>NPS</label><input type="NPS"  name="NPS" value="<?=$monitors['NPS']?>" id="NPS" >

        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>