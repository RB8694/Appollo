<?php

session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;

include 'functions.php';
//$pdo = pdo_connect_mysql();
$server = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$db = 'test2';

$con = mysqli_connect($server, $dbuser, $dbpassword, $db);



$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_POST['Name'])) 
{
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Manager = $_POST['Manager'];
    $Department = $_POST['Department'];
    $Team = $_POST['Team'];
    $Location = $_POST['Location'];

    $sql = "INSERT INTO customer (Name, Email, Manager, Department, Team, Location) VALUES ('$Name', '$Email', '$Manager', '$Department', '$Team', '$Location')";
    //$sql2 = "INSERT INTO bexstaff(Name, Email) VALUES ('$Name', '$Email')";
    //$sql3 = "UPDATE laptops SET User = '$Name' WHERE '$Laptop' = Asset_No";


    if (mysqli_query($con, $sql)) {
        $msg = "New Application Added Successfully";
    } else {
	    $msg = "Error Adding New Starter";
    }

    //if (mysqli_query($con, $sql2)) {
       //$msg = "New Application Added Successfully";
    //} else {
	   // $msg = "Error Adding New Starter";
   // }

    //if (mysqli_query($con, $sql3)) {
      //  $msg = "New Application Added Successfully";
    //} else {
	  //  $msg = "Error Adding New Starter";
    //}

    header('Location: bexleystaff2.php');

    mysqli_close($con);
    }
}
?>

<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">
           <style>
body {font-family: Arial;}

.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

.tab button:hover {
  background-color: #ddd;
}

.tab button.active {
  background-color: #ccc;
}

.tabcontent {
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  width: 80%;
  grid-column: 1/2;
  padding: 10px;
  max-width: auto;
}
.tabcontent2 {
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  width: 50%;
  grid-column: 2/2;
  padding: 10px;
  max-width: auto;
}
.tabcontent input {
  border: 1px solid #ccc;
  padding: 7px;
  margin: 10px;
}
.tabcontent label {
  margin-top: 10px;
  margin-left: 10px;
}
.tabcontent select {
  margin-top: 10px;
  margin-left: 10px;
  padding: 7px;
}
.tabcontent textarea {
  margin-top: 10px;
  margin-left: 10px;
  padding: 7px;
}

#NewStarter{
    display: none;
}
#QA{
    display: none;
}
#Stage{
    display: none;
}

.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
  margin-left:10px;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -60px;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

</style>
</head>

<?=template_header('Read')?>

<div class="tab">
  <button class="tablinks" onclick="Tab(event, 'Customer')">Create Customer</button>
  <button class="tablinks" onclick="Tab(event, 'NewStarter')">New Starter</button>
  <button class="tablinks" onclick="Tab(event, 'QA')">QA</button>
  <button class="tablinks" onclick="Tab(event, 'Stage')">Stage</button>
</div>

<form action="create-user2.php?AppName=<?=$softwares['AppName']?>" method="post">
<div class="updatesoftware">
<div id="Customer" class="tabcontent">
  <h3>Customer</h3>
        <label>Name</label><input type="text" name="Name" id="Name">
        <label>Email</label><input type="Email" name="Email" id="Email">
        <label>Manager</label><input type="text" name="Manager" id="Manager">
        <label>Department</label><input type="text" name="Department" id="Department">
        <label>Team</label><input type="text" name="Team" id="Team">
        <label>Location</label><input type="text" name="Location" id="Location">

</div>
        
<div id="NewStarter" class="tabcontent">
  <h3>New Starter</h3>
      
        <label>Task</label><input type="text" name="Task" id="Task">
        <label>InstallDate</label><input type="Email" name="InstallDate" id="InstallDate">
        <label>Installer</label><input type="text" name="Installer" id="Installer">
        <label>Build</label><input type="text" name="Build" id="Build">
        <label>Bag</label><input type="text" name="Bag" id="Bag">
        <label>Headset</label><input type="text" name="Headset" id="Headset">
        <label>Power Supply</label><input type="text" name="Power Supply" id="Power Supply">
        <label>Sleeve</label><input type="text" name="Sleeve" id="Sleeve">

        <br><br>
        <input type="submit" value="Update">
   

</div>
 
        <input type="submit" value="Insert">
    </form>

<script>
function Tab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "grid";
  evt.currentTarget.className += " active";
}
</script>

    <?php if ($msg): 
    //header('Location: software.php');
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>