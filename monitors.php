<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


if (isset($_GET['search'])) {
$cmd = $pdo->prepare('SELECT * FROM monitors WHERE Asset_No LIKE ? OR User LIKE ? ORDER BY Asset_No ASC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%"]);
$monitor = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM monitors ORDER BY Asset_No');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$monitor = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM monitors')->fetchColumn();
}
?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Monitors')?>

<div class="content read">
	<h2>Monitors</h2>
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
                <td>Serial_Number</td>
                <td>User</td>
                <td>Date</td>
                <td>Model</td>
                <td>Assigned</td>
                <td>NPS</td>               
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($monitor as $monitors): ?>
            <tr>
                <td><?=$monitors['Asset_No']?></td>
                <td><?=$monitors['Serial_Number']?></td>
                <td><?=$monitors['User']?></td>
                <td><?=$monitors['Date']?></td>
                <td><?=$monitors['Model']?></td>
                <td><?=$monitors['Assigned']?></td>
                <td><?=$monitors['NPS']?></td>
                <td class="actions">
                    <a href="update-monitors.php?Asset_No=<?=$monitors['Asset_No']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
                   <!-- <a href="delete.php?Asset_No=<?=$monitors['Asset_No']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a> -->
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