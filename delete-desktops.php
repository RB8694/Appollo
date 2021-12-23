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
        $RAM = isset($_POST['RAM']) ? $_POST['RAM'] : '';
        $CPU = isset($_POST['CPU']) ? $_POST['CPU'] : '';
        $MAC_Address = isset($_POST['MAC_Address']) ? $_POST['MAC_Address'] : '';
        $Serial_Number = isset($_POST['Serial_Number']) ? $_POST['Serial_Number'] : '';
        $Product_Number = isset($_POST['Product_Number']) ? $_POST['Product_Number'] : '';
        $Location = isset($_POST['Location']) ? $_POST['Location'] : '';
        $Assigned = isset($_POST['Assigned']) ? $_POST['Assigned'] : '';

        // Update the record
        $stmt = $pdo->prepare('DELETE FROM Desktops WHERE Asset_No = ?');
        $stmt->execute([$Asset_No, $Make, $Model, $RAM, $CPU, $MAC_Address, $Serial_Number, $Product_Number, $Location, $Assigned, $_GET['Asset_No']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('DELETE FROM Desktops WHERE Asset_No = ?');
    $stmt->execute([$_GET['Asset_No']]);
    $desktops = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$desktops) {
        $msg = 'Successfully Deleted The Asset!';
        header('Location: desktops.php');
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

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Asset #<?=$desktops['Asset_No']?></h2>
    <form action="update-Desktops.php?Asset_No=<?=$desktops['Asset_No']?>" method="post">
        <label>Laptop Number</label><input type="Asset_No" name="Asset_No" value="<?=$desktops['Asset_No']?>" id="Asset_No" readonly>
        <label>Make</label><input type="Make" name="Make" value="<?=$desktops['Make']?>" id="Make" readonly>
        <label>Model</label><input type="Model" name="Model" value="<?=$desktops['Model']?>" id="Model" readonly>
        <label>RAM</label><input type="RAM" name="RAM" value="<?=$desktops['RAM']?>" id="RAM">
        <label>CPU</label><input type="CPU" name="CPU" value="<?=$desktops['CPU']?>" id="CPU" readonly>
        <label>MAC Address</label><input type="MAC_Address" name="MAC_Address" value="<?=$desktops['MAC_Address']?>" id="MAC_Address" >
        <label>Serial Number</label><input type="Serial_Number" name="Serial_Number" value="<?=$desktops['Serial_Number']?>" id="Serial_Number" readonly>
        <label>Product Number</label><input type="Product_Number" name="Product_Number" value="<?=$desktops['Product_Number']?>" id="Product_Number" readonly>
        <label>Location</label><input type="Location" name="Location" value="<?=$desktops['Location']?>" id="Location" >
        <label>Assigned</label><input type="Assigned"  name="Assigned" value="<?=$desktops['Assigned']?>" id="Assigned" >
        <input type="submit" value="Delete">
    </form>
    <?php if ($msg):
    header('Location: desktops.php');
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>