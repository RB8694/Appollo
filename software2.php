<?php

session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;

include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


if (isset($_GET['search'])) {
$cmd = $pdo->prepare('SELECT * FROM apps2 WHERE AppName LIKE ? OR AppVendor LIKE ? OR Prereqs LIKE ? OR Packager LIKE ? ORDER BY AppName ASC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%"]);
$app = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM apps2 ORDER BY AppName');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$app = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM apps2')->fetchColumn();
}
}
else 
	header('Location: login.php');
?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?=template_header('Applications')?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="content read">
	<h2>Software</h2>
	<a href="create-app2.php" class="create-contact">Add App</a>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table>
        <thead>
            <tr>
                <td>App Name</td>
                <td>App Vendor</td>
                <td>App Version</td>
                <td>Vendor Site</td>
                <td>Vendor Phone</td>
                <td>Vendor Email</td>
                <td>File Type</td>
                <td>Known Issues</td>
                <td>Prereqs</td>
                <td>Packager</td>
                <td>Source Location</td>
                <td>Method</td>
                <td>Install</td>
                <td>Uninstall</td>
                <td>Repair</td>
                <td>Vendor Info in SCCM</td>
                <td>Complexity</td>
                <td>Tested</td>
                <td>QA Engineer</td>
                <td>Date Completed</td>
                <td>Stage</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($app as $apps): ?>
            <tr>
                <td><?=$apps['AppName']?></td>
                <td><?=$apps['AppVendor']?></td>
                <td><?=$apps['AppVersion']?></td>
                <td><?=$apps['VendorSite']?></td>
                <td><?=$apps['VendorPhone']?></td>
                <td><?=$apps['VendorEmail']?></td>
                <td><?=$apps['FileType']?></td>
                <td><?=$apps['KnownIssues']?></td>
                <td><?=$apps['Prereqs']?></td>
                <td><?=$apps['Packager']?></td>
                <td><?=$apps['SourceLocation']?></td>
                <td><?=$apps['Method']?></td>
                <td><?=$apps['Install']?></td>
                <td><?=$apps['Uninstall']?></td>
                <td><?=$apps['Repair']?></td>
                <td><?=$apps['VendorSCCM']?></td>
                <td><?=$apps['Complexity']?></td>
                <td><?=$apps['Tested']?></td>
                <td><?=$apps['QAEngineer']?></td>
                <td><?=$apps['DateCompleted']?></td>
                <td><?=$apps['Stage']?></td>
                <td class="actions">
                    <a href="update-software2.php?AppName=<?=$apps['AppName']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
                   <!-- <a href="delete.php?AppName=<?=$apps['AppName']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<footer>   
    <?php
    
    echo "<p>Copyright Robert Burt &copy; " . date("Y");
   ?>
</footer>

<?php
//include 'footer.php';

?>
	<!--<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_laptops): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>-->
</div>

<?=template_footer()?>