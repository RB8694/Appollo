<?php
session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;
include 'functions.php';
$pdo = pdo_connect_mysql();

$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1

//var_dump($_GET['CR']);

if (isset($_GET['CR'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $CR = isset($_POST['CR']) ? $_POST['CR'] : '';
        $Name = isset($_POST['Name']) ? $_POST['Name'] : '';
        $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
        $Manager = isset($_POST['Manager']) ? $_POST['Manager'] : '';
        $CostCode = isset($_POST['CostCode']) ? $_POST['CostCode'] : '';
        $Dated = isset($_POST['Dated']) ? $_POST['Dated'] : '';
        $Build = isset($_POST['Build']) ? $_POST['Build'] : '';
        $NPS = isset($_POST['NPS']) ? $_POST['NPS'] : '';
        $Laptop = isset($_POST['Laptop']) ? $_POST['Laptop'] : '';
        $Bag = isset($_POST['Bag']) ? $_POST['Bag'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE newstarters SET CR = ?, Name = ?, Email = ?, Manager = ?, CostCode = ?, Dated = ?, Build = ?, NPS = ?, Laptop = ?, Bag = ? WHERE CR = ?');
        $stmt->execute([$CR, $Name, $Email, $Manager, $CostCode, $Dated, $Build, $NPS, $Laptop, $Bag, $_GET['CR']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM newstarters WHERE CR = ?');
    $stmt->execute([$_GET['CR']]);
    $newstarters = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if (!$newstarters) {
        exit('User doesn\'t exist with that CR!');
    }
} else {
    exit('No name specified!');
}
}
else 
	header('Location: login.php');



?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Update User')?>

<div class="content update">
	<h2>Update Newstarter <?=$newstarters['CR']?></h2>
    <form action="update-user.php?CR=<?=$newstarters['CR']?>" method="post">
        <label>Task</label><input type="text" name="CR" value="<?=$newstarters['CR']?>" id="CR" style="text-transform:uppercase" readonly>
        <label>Name</label><input type="text" name="Name"  value="<?=$newstarters['Name']?>" id="Name" style='text-transform:uppercase'>
        <label>Email</label><input type="text" name="Email" id="Email" value="<?=$newstarters['Email']?>">
        <label>Manager</label><input type="text" name="Manager" id="Manager" value="<?=$newstarters['Manager']?>">
        <label>CostCode</label><input type="text" name="CostCode" id="CostCode" value="<?=$newstarters['CostCode']?>">
        <label>Dated</label><input type="Datetime-local" name="Dated" id="Dated" value="<?=$newstarters['Dated']?>">
        <label>Build</label><br><br>
        <select name="Build" id="table" >
        <option <?php if($newstarters['Build']=="ACAD") echo "selected"; ?> value="ACAD">ACAD</option>
        <option <?php if($newstarters['Build']=="CORP") echo "selected"; ?> value="CORP">CORP</option>
        <option <?php if($newstarters['Build']=="Desktop") echo "selected"; ?> value="Desktop">Desktop</option>
        </select>
        <label>NPS</label>
        <select name="NPS" id="table" >
        <option <?php if($newstarters['NPS']=="Rob") echo "selected"; ?> value="Rob">Rob</option>
        <option <?php if($newstarters['NPS']=="Olly") echo "selected"; ?> value="Olly">Olly</option>
        <option <?php if($newstarters['NPS']=="Pat") echo "selected"; ?> value="Pat">Pat</option>
        <option <?php if($newstarters['NPS']=="Vinh") echo "selected"; ?> value="Vinh">Vinh</option>
        </select>
        <label>Laptop</label><input type="text" name="Laptop" id="Laptop" style='text-transform:uppercase' value="<?=$newstarters['Laptop']?>">
        <label>Bag</label><br><br>
        <select name="Bag" id="table" >
        <option <?php if($newstarters['Bag']=="Rucksack") echo "selected"; ?> value="Rucksack">Rucksack</option>
        <option <?php if($newstarters['Bag']=="Trolley") echo "selected"; ?> value="Trolley">Trolley</option>
        <option <?php if($newstarters['Bag']=="None") echo "selected"; ?> value="None">None</option>
        </select>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): 
    //header('Location: newstarter.php');
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>