<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


if (isset($_GET['search'])) {
$cmd = $pdo->prepare('SELECT * FROM laptops WHERE Asset_No LIKE ? OR Faulty LIKE ? OR Decommissioned LIKE ? OR Assigned LIKE ? OR User LIKE ? OR MAC_Address LIKE ? ORDER BY Asset_No ASC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%"]);
$laptop = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM laptops ORDER BY Asset_No');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$laptop = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM laptops')->fetchColumn();
}


?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('Read')?>

<div class="content read">
	<h2>Laptops</h2>
	<a href="create.php" class="create-contact">Add Device</a>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table class="faulty2">
        <thead>
            <tr>
                <td style="width:120px";>Asset_No</td>
                <!--<td>Make</td>
                <td>Model</td>
                <td>RAM</td>
                <td>CPU</td>
                <td>MAC_Address</td>
                <td>Serial_Number</td>
                <td>Product_Number</td>
                <td>User</td>
                <td>Location</td>
                <td>Assigned</td>
                <td>Faulty</td>-->
                <td style="width:150px";>Decommissioned</td>
                <td style="width:150px";>History</td>
                <td style="width:150px";>Screen</td>
                <td style="width:150px";>Keyboard</td>
                <td style="width:150px";>Battery</td>
                <td style="width:150px";>RAM</td>
                <td style="width:150px";>SSD</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laptop as $laptops): ?>
            <tr>
                <td><?=$laptops['Asset_No']?></td>
                <!--<td><?=$laptops['Make']?></td>
                <td><?=$laptops['Model']?></td>
                <td><?=$laptops['RAM']?></td>
                <td><?=$laptops['CPU']?></td>
                <td><?=$laptops['MAC_Address']?></td>
                <td><?=$laptops['Serial_Number']?></td>
                <td><?=$laptops['Product_Number']?></td>
                <td><?=$laptops['User']?></td>
                <td><?=$laptops['Location']?></td>
                <td><?=$laptops['Assigned']?></td>
                <td><?=$laptops['Faulty']?></td>-->
                <td><?=$laptops['Decommissioned']?></td>
                <td><?=$laptops['History']?></td>
                <td><?=$laptops['Screen']?></td>
                <td><?=$laptops['Keyboard']?></td>
                <td><?=$laptops['Battery']?></td>
                <td><?=$laptops['RAM2']?></td>
                <td><?=$laptops['SSD2']?></td>
                <td class="actions">
                    <a href="faulty.php?Asset_No=<?=$laptops['Asset_No']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
                  <!--  <a href="delete.php?Asset_No=<?=$laptops['Asset_No']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>  -->
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