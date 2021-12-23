<?php
session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['AppName'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $AppName = isset($_POST['AppName']) ? $_POST['AppName'] : '';
        $AppVendor = isset($_POST['AppVendor']) ? $_POST['AppVendor'] : '';
        $AppVersion = isset($_POST['AppVersion']) ? $_POST['AppVersion'] : '';
        $VendorSite = isset($_POST['VendorSite']) ? $_POST['VendorSite'] : '';
        $VendorPhone = isset($_POST['VendorPhone']) ? $_POST['VendorPhone'] : '';
        $VendorEmail = isset($_POST['VendorEmail']) ? $_POST['VendorEmail'] : '';
        $FileType = isset($_POST['FileType']) ? $_POST['FileType'] : '';
        $KnownIssues = isset($_POST['KnownIssues']) ? $_POST['KnownIssues'] : '';
        $Prereqs = isset($_POST['Prereqs']) ? $_POST['Prereqs'] : '';
        $Packager = isset($_POST['Packager']) ? $_POST['Packager'] : '';
        $SourceLocation = isset($_POST['SourceLocation']) ? $_POST['SourceLocation'] : '';
        $Method = isset($_POST['Method']) ? $_POST['Method'] : '';
        $Install = isset($_POST['Install']) ? $_POST['Install'] : '';
        $Uninstall = isset($_POST['Uninstall']) ? $_POST['Uninstall'] : '';
        $Repair = isset($_POST['Repair']) ? $_POST['Repair'] : '';
        $VendorSCCM = isset($_POST['VendorSCCM']) ? $_POST['VendorSCCM'] : '';
        $Complexity = isset($_POST['Complexity']) ? $_POST['Complexity'] : '';
        $Tested = isset($_POST['Tested']) ? $_POST['Tested'] : '';
        $QAEngineer = isset($_POST['QAEngineer']) ? $_POST['QAEngineer'] : '';
        $DateCompleted = isset($_POST['DateCompleted']) ? $_POST['DateCompleted'] : '';
        $Stage = isset($_POST['Stage']) ? $_POST['Stage'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE Apps2 SET AppName = ?, AppVendor = ?, AppVersion = ?, VendorSite = ?, VendorPhone = ?, VendorEmail = ?, FileType = ?, KnownIssues = ?, Prereqs = ?, Packager = ?, SourceLocation = ?, Method = ?, Install = ?, Uninstall = ?, Repair = ?, VendorSCCM = ?, Complexity = ?, Tested = ?, QAEngineer = ?, DateCompleted = ?, Stage = ? WHERE AppName = ?');
        $stmt->execute([$AppName, $AppVendor, $AppVersion, $VendorSite, $VendorPhone, $VendorEmail, $FileType, $KnownIssues, $Prereqs, $Packager, $SourceLocation, $Method, $Install, $Uninstall, $Repair, $VendorSCCM, $Complexity, $Tested, $QAEngineer, $DateCompleted, $Stage, $_GET['AppName']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM Apps2 WHERE AppName = ?');
    $stmt->execute([$_GET['AppName']]);
    $softwares = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$softwares) {
        exit('App doesn\'t exist with that name!');
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

#Packaging{
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

<?=template_header('Update Applications')?>

<div class="tab">
  <button class="tablinks" onclick="Tab(event, 'Discovery')">Discovery</button>
  <button class="tablinks" onclick="Tab(event, 'Packaging')">Packaging</button>
  <button class="tablinks" onclick="Tab(event, 'QA')">QA</button>
  <button class="tablinks" onclick="Tab(event, 'Stage')">Stage</button>
</div>

<form action="update-software2.php?AppName=<?=$softwares['AppName']?>" method="post">
<div class="updatesoftware">
<div id="Discovery" class="tabcontent">
  <h3>Discovery</h3>
        <label style="width:150px">App Name</label><input type="AppName" name="AppName" value="<?=$softwares['AppName']?>" id="AppName-update" readonly>
        <label style="width:150px">App Vendor</label><input type="AppVendor" name="AppVendor" value="<?=$softwares['AppVendor']?>" id="AppVendor-update" readonly>
        <label style="width:150px">App Version</label><input type="AppVersion" name="AppVersion" value="<?=$softwares['AppVersion']?>" id="AppVersion-update" readonly>
        <label style="width:150px">Vendor Site</label><input type="VendorSite" name="VendorSite" value="<?=$softwares['VendorSite']?>" id="VendorSite-update">
        <label style="width:150px">Vendor Phone</label><input type="VendorPhone" name="VendorPhone" value="<?=$softwares['VendorPhone']?>" id="VendorPhone-update">
        <label style="width:150px">Vendor Email</label><input type="VendorEmail" name="VendorEmail" value="<?=$softwares['VendorEmail']?>" id="VendorEmail-update">
        <label style="width:150px">File Type</label> <!--<input type="FileType" name="FileType" value="<?=$softwares['FileType']?>" id="FileType">-->
        <select name="FileType" id="FileType-update">
        <option <?php if($softwares['FileType']=="") echo "selected"; ?> value=""></option>
        <option <?php if($softwares['FileType']=="EXE") echo "selected"; ?> value="EXE">EXE</option>
        <option <?php if($softwares['FileType']=="MSI") echo "selected"; ?> value="MSI">MSI</option>
        <option <?php if($softwares['FileType']=="MSIX") echo "selected"; ?> value="MSIX">MSIX</option>
        <option <?php if($softwares['FileType']=="APPV") echo "selected"; ?> value="APPV">APPV</option>
        <option <?php if($softwares['FileType']=="Script") echo "selected"; ?> value="Script">Script</option>
        </select>

        <label>Known Issues</label><input type="KnownIssues" name="KnownIssues" value="<?=$softwares['KnownIssues']?>" id="KnownIssues-update">
        <label>Prereqs</label><input type="Prereqs" name="Prereqs" value="<?=$softwares['Prereqs']?>" id="Prereqs-update">
        <br><br>
        <input type="submit" value="Update">
        
</div>
        
<div id="Packaging" class="tabcontent">
  <h3>Packaging</h3>

        <label>Packager</label>
        <select name="Packager" id="Packager-update">
        <option <?php if($softwares['Packager']=="Chris Giannopoulos") echo "selected"; ?> value="Chris Giannopoulos">Chris Giannopoulos</option>
        <option <?php if($softwares['Packager']=="Linda Pilgrim") echo "selected"; ?> value="Linda Pilgrim">Linda Pilgrim</option>
        <option <?php if($softwares['Packager']=="James Collis") echo "selected"; ?> value="James Collis">James Collis</option>
        <option <?php if($softwares['Packager']=="Ian Taylor") echo "selected"; ?> value="Ian Taylor">Ian Taylor</option>
        </select>

        <label>Source Location</label><input type="SourceLocation" name="SourceLocation" value="<?=$softwares['SourceLocation']?>" id="SourceLocation">
        <label>Method</label><input type="Method" name="Method" value="<?=$softwares['Method']?>" id="Method-update">

        <label>Install</label><!--<input type="Install" name="Install" value="<?=$softwares['Install']?>" id="Install" style="width:900px";>-->
        <textarea name="Install"  id="Install-update"> <?php echo $softwares['Install']?></textarea>

        <label>Uninstall</label><!--<input type="Install" name="Install" value="<?=$softwares['Install']?>" id="Install" style="width:900px";>-->
        <textarea name="Uninstall"  id="Uninstall-update"> <?php echo $softwares['Uninstall']?></textarea>

        <label>Repair</label><!--<input type="Install" name="Install" value="<?=$softwares['Install']?>" id="Install" style="width:900px";>-->
        <textarea name="Repair"  id="Repair-update"> <?php echo $softwares['Repair']?></textarea>

        <label>Vendor SCCM <body><div class="tooltip" margin-left:"5px"><i class="fas fa-info-circle"></i><span class="tooltiptext">Is the Vendor information listed in SCCM?</span></div></label>
        <select name="VendorSCCM" id="VendorSCCM-update">
        <option <?php if($softwares['VendorSCCM']=="Yes") echo "selected"; ?> value="Yes">Yes</option>
        <option <?php if($softwares['VendorSCCM']=="No") echo "selected"; ?> value="No">No</option>
        </select>

        <label>Complexity</label>
        <select name="Complexity" id="Complexity-update">
        <option <?php if($softwares['Complexity']=="Hard") echo "selected"; ?> value="Hard">Hard</option>
        <option <?php if($softwares['Complexity']=="Medium") echo "selected"; ?> value="Medium">Medium</option>
        <option <?php if($softwares['Complexity']=="Basic") echo "selected"; ?> value="Basic">Basic</option>
        </select>

        <label>Tested</label>
        <select name="Tested" id="Tested-update">
        <option <?php if($softwares['Tested']=="Yes") echo "selected"; ?> value="Yes">Yes</option>
        <option <?php if($softwares['Tested']=="No") echo "selected"; ?> value="No">No</option>
        </select>
        <br><br>
        <input type="submit" value="Update">
   

</div>

<div id="QA" class="tabcontent">
  <h3>QA</h3>
     
        <label>QAEngineer</label>
        <select name="QAEngineer">
        <option <?php if($softwares['QAEngineer']=="Chris Giannopoulos") echo "selected"; ?> value="Chris Giannopoulos">Chris Giannopoulos</option>
        <option <?php if($softwares['QAEngineer']=="Linda Pilgrim") echo "selected"; ?> value="Linda Pilgrim">Linda Pilgrim</option>
        <option <?php if($softwares['QAEngineer']=="James Collis") echo "selected"; ?> value="James Collis">James Collis</option>
        <option <?php if($softwares['QAEngineer']=="Ian Taylor") echo "selected"; ?> value="Ian Taylor">Ian Taylor</option>
        <option <?php if($softwares['QAEngineer']=="Mike Lecomber") echo "selected"; ?> value="Mike Lecomber">Mike Lecomber</option>
        </select>
        <label>Date Completed</label><input type="Date" name="DateCompleted" value="<?=$softwares['DateCompleted']?>" id="DateCompleted">
        <br><br>
        <input type="submit" value="Update">
 
</div>
<div id="Stage" class="tabcontent">
  <h3>Stage</h3>
     
        <label>Stage</label>
        <select name="Stage">
        <option <?php if($softwares['Stage']=="Live") echo "selected"; ?> value="Live">Live</option>
        <option <?php if($softwares['Stage']=="Retired") echo "selected"; ?> value="Retired">Retired</option>
        <option <?php if($softwares['Stage']=="QA") echo "selected"; ?> value="QA">QA</option>
        <option <?php if($softwares['Stage']=="UAT") echo "selected"; ?> value="UAT">UAT</option>
        <option <?php if($softwares['Stage']=="Dev") echo "selected"; ?> value="Dev">Dev</option>
        </select>
        <input type="submit" value="Update">
 
</div>

</div>
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
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>