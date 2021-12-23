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
if (isset($_POST['AppName'])) 
{
    $AppName = $_POST['AppName'];
    $AppVendor = $_POST['AppVendor'];
    $AppVersion = $_POST['AppVersion'];
    $VendorSite = $_POST['VendorSite'];
    $VendorPhone = $_POST['VendorPhone'];
    $VendorEmail = $_POST['VendorEmail'];
    $FileType = $_POST['FileType'];
    $KnownIssues = $_POST['KnownIssues'];
    $Prereqs = $_POST['Prereqs'];
    $Packager = $_POST['Packager'];
    $SourceLocation = $_POST['SourceLocation'];
    $Method = $_POST['Method'];
    $Install = $_POST['Install'];
    $Uninstall = $_POST['Uninstall'];
    $Repair = $_POST['Repair'];
    $VendorSCCM = $_POST['VendorSCCM'];
    $Complexity = $_POST['Complexity'];
    $Tested = $_POST['Tested'];
    $QAEngineer = $_POST['QAEngineer'];
    $DateCompleted = $_POST['DateCompleted'];
    $Stage = $_POST['Stage'];


    $sql = "INSERT INTO Apps2 (AppName, AppVendor, AppVersion, VendorSite, VendorPhone, VendorEmail, FileType, KnownIssues, Prereqs, Packager, SourceLocation, Method, Install, Uninstall, Repair, VendorSCCM, Complexity, Tested, QAEngineer, DateCompleted, Stage) VALUES ('$AppName', '$AppVendor', '$AppVersion', '$VendorSite', '$VendorPhone', '$VendorEmail', '$FileType', '$KnownIssues', '$Prereqs', '$Packager', '$SourceLocation', '$Method', '$Install', '$Uninstall', '$Repair', '$VendorSCCM', '$Complexity', '$Tested', '$QAEngineer', '$DateCompleted' , '$Stage')";

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

<?=template_header('Read')?>

<div class="content-software update-software">
	<h2>Create Application</h2><br>
    <form action="create-app2.php" method="post">
        <label>App Name</label><input type="AppName" name="AppName" id="AppName" style="width:500px">
        <label>App Vendor</label><input type="AppVendor" name="AppVendor" id="AppVendor" style="width:500px">
        <label>App Version</label><input type="AppVersion" name="AppVersion" id="AppVersion" style="width:500px">
        <label>Vendor Site</label><input type="VendorSite" name="VendorSite" id="VendorSite" style="width:500px">
        <label>Vendor Phone</label><input type="VendorPhone" name="VendorPhone" id="VendorPhone" style="width:500px">
        <label>Vendor Email</label><input type="VendorEmail" name="VendorEmail" id="VendorEmail" style="width:500px">
        <label>File Type</label>        
        <select name="FileType" id="table" style="width:500px">
        <option value="EXE">EXE</option>
        <option value="MSI">MSI</option>
        <option value="MSIX">MSIX</option>
        <option value="APPV">APPV</option>
        </select>
        <label>Known Issues</label>     
        <textarea name="KnownIssues" style="width:500px"></textarea>
        <label>Prereqs</label>      
        <textarea name="Prereqs" style="width:500px"></textarea>
        
        <label>Packager</label>     
        <select name="Packager" id="table" style="width:500px">
        <option value="Chris Giannopoulos">Chris Giannopoulos</option>
        <option value="Linda Pilgrim">Linda Pilgrim</option>
        <option value="Ian Taylor">Ian Taylor</option>
        <option value="James Collis">James Collis</option>
        </select>


        <label>Source Location</label>     
        <textarea name="SourceLocation" style="width:500px"></textarea>

        <label>Method</label><input type="Method" name="Method" id="Method" style="width:500px">
        
     
        
        <!--<label>Install</label>              
        <textarea name="Install" style="width:500px"></textarea>

        <label>Uninstall</label>            
        <textarea name="Uninstall" style="width:500px"></textarea>

        <label>Repair</label>               
        <textarea name="Repair" style="width:500px"></textarea>


        <label>Vendor Info in SCCM</label>  
        <select name="VendorSCCM" id="table" >
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>


        <label>Complexity</label>      
        <select name="Complexity" id="table" style="width:500px">
        <option value="Hard">Hard</option>
        <option value="Medium">Medium</option>
        <option value="Basic">Basic</option>
        </select>



        <label>Tested</label>           
        <select name="Tested" id="table" style="width:500px">
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>

        <label>QA Engineer</label>
        <select name="QAEngineer" id="table" style="width:500px">
        <option value="Mike Lecomber">Mike Lecomber</option>
        <option value="Chris Giannopoulos">Chris Giannopoulos</option>
        <option value="Linda Pilgrim">Linda Pilgrim</option>
        <option value="Ian Taylor">Ian Taylor</option>
        <option value="James Collis">James Collis</option>
        <option value="No">No</option>
        </select>

        <label>Date Completed</label><input type="date" name="DateCompleted" id="DateCompleted" style="width:500px">-->

        

        <!--label>Stage</label><br><br>
        <select name="Stage" id="table" >
        <option value="Dev">Dev</option>
        <option value="QA">QA</option>
        <option value="UAT">UAT</option>
        <option value="Live">Live</option>
        <option value="Retired">Retired</option>
        </select>
        <label>Packager</label>
        <select name="Packager" id="table" >
        <option value="Chris Giannopoulos">Chris Giannopoulos</option>
        <option value="Linda Pilgrim">Linda Pilgrim</option>
        <option value="James Collis">James Collis</option>
        </select>
        <label>Updated</label><input type="Date" name="Updated" id="Updated">
        <label>Path</label><input type="text" name="Path" id="Path" style="width:750px">
        <label>QA Completed</label>
        <select name="QA" id="table" >
        <option value="No">No</option>
        <option value="Yes - Mike Lecomber">Yes - Mike Lecomber</option>
        <option value="Yes - Chris Giannopoulos">Yes - Chris Giannopoulos</option>
        <option value="Yes - Vinh San">Yes - Vinh San</option>
        <option value="Yes - Linda Pilgrim">Yes - Linda Pilgrim</option>
        <option value="Yes - James Collis">Yes - James Collis</option>
        <option value="Yes - Ian Taylor">Yes - Ian Taylor</option>
        </select>
        <label>QA Notes</label><input type="Notes" name="Notes" id="Notes">
        <label>AD Group</label><input type="AD" name="AD" id="AD">
        <label>Install</label><input type="Install" name="Install" id="Install" style="width:750px">
        <label>Uninstall</label><input type="Uninstall" name="Uninstall" id="Uninstall" style="width:750px">-->



        <input type="submit" value="Insert">
    </form>
    </div>
    <?php if ($msg): 
    ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>