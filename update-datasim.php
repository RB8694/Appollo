<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['ID'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $ID = isset($_POST['ID']) ? $_POST['ID'] : '';
        $Sim_Number = isset($_POST['Sim_Number']) ? $_POST['Sim_Number'] : '';
        $Mobile_Number = isset($_POST['Mobile_Number']) ? $_POST['Mobile_Number'] : '';
        $User = isset($_POST['User']) ? $_POST['User'] : '';
        $Assigned = isset($_POST['Assigned']) ? $_POST['Assigned'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE Datasim SET ID = ?, Sim_Number = ?, User = ?, Assigned = ?, WHERE ID = ?');
        $stmt->execute([$ID, $Sim_Number, $Mobile_Number, $User, $Assigned, $_GET['ID']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM Datasim WHERE ID = ?');
    $stmt->execute([$_GET['ID']]);
    $datasims = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$datasims) {
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

<?=template_header('Update DataSim')?>

<div class="content update">
	<h2>Update Contact #<?=$datasims['ID']?></h2>
    <form action="update-datasim.php?Asset_No=<?=$datasims['ID']?>" method="post">
        <label>ID</label><input type="ID" name="ID" value="<?=$datasims['ID']?>" id="ID" readonly>
        <label>Sim Number</label><input type="Sim_Number" name="Sim_Number" value="<?=$datasims['Sim_Number']?>" id="Sim_Number" readonly>
        <label>Mobile Number</label><input type="Mobile_Number" name="Mobile_Number" value="<?=$datasims['Mobile_Number']?>" id="Mobile_Number" >
        <label>User</label><input type="User" name="User" value="<?=$datasims['User']?>" id="User" >
        <label>Assigned</label><input type="Assigned"  name="Assigned" value="<?=$datasims['Assigned']?>" id="Assigned" >
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>