<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


if (isset($_GET['search'])) {
$cmd = $pdo->prepare('SELECT * FROM hardware WHERE Asset_No LIKE ? OR Fault LIKE ? OR RepairedBy LIKE ? OR Repaired LIKE ? ORDER BY Dated desc');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%"]);
$hardware = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM hardware ORDER BY Dated ASC');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$hardware = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM hardware')->fetchColumn();
}
?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Read')?>

<div class="content read">
	<h2>Faults</h2>
	<a href="create-fault.php" class="create-contact">Log Fault</a>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table class="a">
        <thead>
            <tr>
                <td>Asset_No</td>
                <td>Date Logged</td>
                <td>Fault</td>
                <td>RepairedBy</td>
                <td>Repaired</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hardware as $hardwares): ?>
            <tr>
                <td><?=$hardwares['Asset_No']?></td>
                <td><?=$hardwares['Dated']?></td>
                <td><?=$hardwares['Fault']?></td>
                <td><?=$hardwares['RepairedBy']?></td>
                <td><?=$hardwares['Repaired']?></td>
                <td class="actions">
                   <a href="update-faults.php?Asset_No=<?=$hardwares['Asset_No']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                  <!--  <a href="delete.php?ID=<?=$hardwares['ID']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a> -->
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