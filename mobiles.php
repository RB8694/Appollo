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
$cmd = $pdo->prepare('SELECT * FROM mobiles WHERE Asset_No LIKE ? OR User LIKE ? ORDER BY Asset_No ASC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%"]);
$mobile = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM mobiles ORDER BY Asset_No');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$mobile = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM mobiles')->fetchColumn();
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

<?=template_header('Mobiles')?>

<div class="content read">
	<h2>Mobiles</h2>
	<a href="create.php" class="create-contact">Add Device</a>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table>
        <thead>
            <tr>
                <td>Asset_No</td>
                <td>Make</td>
                <td>Model</td>
                <td>Model_Number</td>
                <td>Gmail</td>
                <td>IMEI</td>
                <td>Storage</td>
                <td>Serial_Number</td>
                <td>SIM_Serial_ID</td>
                <td>Mobile_Number</td>
                <td>Notes</td>
                <td>Location</td>
                <td>User</td>
                <td>Assigned</td>
                <td>Faulty</td>
                <td>Decommissioned</td>
                <td>History</td>
                <td>NPS</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mobile as $mobiles): ?>
            <tr>
                <td><?=$mobiles['Asset_No']?></td>
                <td><?=$mobiles['Make']?></td>
                <td><?=$mobiles['Model']?></td>
                <td><?=$mobiles['Model_Number']?></td>
                <td><?=$mobiles['Gmail']?></td>
                <td><?=$mobiles['IMEI']?></td>
                <td><?=$mobiles['Storage']?></td>
                <td><?=$mobiles['Serial_Number']?></td>
                <td><?=$mobiles['SIM_Serial_ID']?></td>
                <td><?=$mobiles['Mobile_Number']?></td>
                <td><?=$mobiles['Notes']?></td>
                <td><?=$mobiles['Location']?></td>
                <td><?=$mobiles['User']?></td>
                <td><?=$mobiles['Assigned']?></td>
                <td><?=$mobiles['Faulty']?></td>
                <td><?=$mobiles['Decommissioned']?></td>
                <td><?=$mobiles['History']?></td>
                <td><?=$mobiles['NPS']?></td>
                <td class="actions">
                    <a href="update-mobiles.php?Asset_No=<?=$mobiles['Asset_No']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
                  <!--  <a href="delete-mobiles.php?Asset_No=<?=$mobiles['Asset_No']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>  -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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