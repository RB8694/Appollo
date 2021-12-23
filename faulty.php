<?php
session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;
include 'functions.php';
$pdo = pdo_connect_mysql();
$con = mysqli_connect("localhost","root","","asset");

$sql = "SELECT * FROM `category`";
$sql2 = "SELECT (Name) FROM bexstaff WHERE Name = ? ";
$all_categories = mysqli_query($con,$sql2);

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
        $User = isset($_POST['User']) ? $_POST['User'] : '';
        $Location = isset($_POST['Location']) ? $_POST['Location'] : '';
        $Assigned = isset($_POST['Assigned']) ? $_POST['Assigned'] : '';
        $Faulty = isset($_POST['Faulty']) ? $_POST['Faulty'] : '';
        $Decommissioned = isset($_POST['Decommissioned']) ? $_POST['Decommissioned'] : '';
        $History = isset($_POST['History']) ? $_POST['History'] : '';
        $Screen = isset($_POST['Screen']) ? $_POST['Screen'] : '';
        $Keyboard = isset($_POST['Keyboard']) ? $_POST['Keyboard'] : '';
        $Battery = isset($_POST['Battery']) ? $_POST['Battery'] : '';
        $RAM2 = isset($_POST['RAM2']) ? $_POST['RAM2'] : '';
        $SSD2 = isset($_POST['SSD2']) ? $_POST['SSD2'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE Laptops SET Asset_No = ?, Faulty = ?, Decommissioned = ?, History = ?, Screen = ?, Keyboard = ?, Battery = ?, RAM2 = ?, SSD2 = ?  WHERE Asset_No = ?');
        $stmt->execute([$Asset_No, $Faulty, $Decommissioned, $History, $Screen, $Keyboard, $Battery, $RAM2, $SSD2, $_GET['Asset_No']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT `Asset_No`, `Make`, `Model`, `RAM`, `CPU`, `MAC_Address`, `Serial_Number`, `Product_Number`, `User`, `Location`, `Assigned`, `Faulty`, `Decommissioned`, `History`, `Screen`, `Keyboard`, `Battery`, `RAM2`, `SSD2`  FROM `laptops` WHERE Asset_No = ?');
    $stmt->execute([$_GET['Asset_No']]);
    $laptops = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$laptops) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}}
?>

<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Asset <?=$laptops['Asset_No']?></h2>
    <form action="faulty.php?Asset_No=<?=$laptops['Asset_No']?>" method="post">
        <label>Laptop Number</label><input type="Asset_No" name="Asset_No" value="<?=$laptops['Asset_No']?>" id="Asset_No" readonly>
        <!--<label>Make</label><input type="Make" name="Make" value="<?=$laptops['Make']?>" id="Make" readonly>
        <label>Model</label><input type="Model" name="Model" value="<?=$laptops['Model']?>" id="Model" readonly>
        <label>RAM</label><input type="RAM" name="RAM" value="<?=$laptops['RAM']?>" id="RAM">
        <label>CPU</label><input type="CPU" name="CPU" value="<?=$laptops['CPU']?>" id="CPU" readonly>
        <label>MAC Address</label><input type="MAC_Address" name="MAC_Address" value="<?=$laptops['MAC_Address']?>" id="MAC_Address" >
        <label>Serial Number</label><input type="Serial_Number" name="Serial_Number" value="<?=$laptops['Serial_Number']?>" id="Serial_Number" readonly>
        <label>Product Number</label><input type="Product_Number" name="Product_Number" value="<?=$laptops['Product_Number']?>" id="Product_Number" readonly>
        <label>User</label><input type="User" name="User" value="<?=$laptops['User']?>" id="User" > 
        <label>Location</label><input type="Location" name="Location" value="<?=$laptops['Location']?>" id="Location" >
        <label>Assigned</label> 
        <select name="Assigned">
        <option <?php if($laptops['Assigned']=="Assigned") echo "selected"; ?> value="Assigned">Assigned</option>
        <option <?php if($laptops['Assigned']=="Returned") echo "selected"; ?> value="Returned">Returned</option>
        </select>-->
        <label>Faulty</label>    
        <select name="Faulty">
        <option <?php if($laptops['Faulty']=="Faulty") echo "selected"; ?> value="Faulty">Faulty</option>
        <option <?php if($laptops['Faulty']=="Working") echo "selected"; ?> value="Working">Working</option>
        </select>

        <label>Decommissioned</label>   
        <select name="Decommissioned">
        <option <?php if($laptops['Decommissioned']=="Decommissioned") echo "selected"; ?> value="Decommissioned">Decommissioned</option>
        <option <?php if($laptops['Decommissioned']=="Functioning") echo "selected"; ?> value="Functioning">Functioning</option>
        </select>

        <label>History</label><input type="History"  name="History" value="<?=$laptops['History']?>" id="History" rows="4">
        <label>Screen</label>   
        <select name="Screen">
        <option <?php if($laptops['Screen']=="In Place") echo "selected"; ?> value="In Place">In Place</option>
        <option <?php if($laptops['Screen']=="Removed") echo "selected"; ?> value="Removed">Removed</option>
        </select>


        <label>Keyboard</label>
        <select name="Keyboard">
        <option <?php if($laptops['Keyboard']=="In Place") echo "selected"; ?> value="In Place">In Place</option>
        <option <?php if($laptops['Keyboard']=="Removed") echo "selected"; ?> value="Removed">Removed</option>
        </select>

        <label>Battery</label>
        <select name="Battery">
        <option <?php if($laptops['Battery']=="In Place") echo "selected"; ?> value="In Place">In Place</option>
        <option <?php if($laptops['Battery']=="Removed") echo "selected"; ?> value="Removed">Removed</option>
        </select>
        <label>RAM</label>
        <select name="RAM2">
        <option <?php if($laptops['RAM2']=="In Place") echo "selected"; ?> value="In Place">In Place</option>
        <option <?php if($laptops['RAM2']=="Removed") echo "selected"; ?> value="Removed">Removed</option>
        </select>
        <label>SSD</label>
        <select name="SSD2">
        <option <?php if($laptops['SSD2']=="In Place") echo "selected"; ?> value="In Place">In Place</option>
        <option <?php if($laptops['SSD2']=="Removed") echo "selected"; ?> value="Removed">Removed</option>
        </select>


        <input type="submit" value="Update">
    </form>
    <?php if ($msg): 
    //header('Location: laptops.php');
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>