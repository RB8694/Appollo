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
$cmd = $pdo->prepare('SELECT * FROM libraries WHERE Asset_No LIKE ? OR Location LIKE ? OR MAC_Address LIKE ? ORDER BY Asset_No ASC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%"]);
$library = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM libraries ORDER BY Asset_No');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$library = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM libraries')->fetchColumn();
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

<?=template_header('Libraries')?>

<div class="content read">
	<h2>Libraries</h2>
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
                <td>RAM</td>
                <td>CPU</td>
                <td>MAC_Address</td>
                <td>Serial_Number</td>
                <td>Product_Number</td>
                <td>Local_Loads</td>
                <td>Location</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($library as $libraries): ?>
            <tr>
                <td><?=$libraries['Asset_No']?></td>
                <td><?=$libraries['Make']?></td>
                <td><?=$libraries['Model']?></td>
                <td><?=$libraries['RAM']?></td>
                <td><?=$libraries['CPU']?></td>
                <td><?=$libraries['MAC_Address']?></td>
                <td><?=$libraries['Serial_Number']?></td>
                <td><?=$libraries['Product_Number']?></td>
                <td><?=$libraries['Local_Loads']?></td>
                <td><?=$libraries['Location']?></td>
                <td class="actions">
                    <a href="update-libraries.php?Asset_No=<?=$libraries['Asset_No']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
                  <!--  <a href="delete-libraries.php?Asset_No=<?=$libraries['Asset_No']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>  -->
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