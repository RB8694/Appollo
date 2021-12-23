<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


if (isset($_GET['search'])) {
$cmd = $pdo->prepare('SELECT * FROM newstarters WHERE CR LIKE ? OR Name LIKE ? OR Manager LIKE ? OR Build LIKE ? OR Laptop LIKE ? OR Dated LIKE ? OR NPS LIKE ? ORDER BY Dated DESC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%"]);
$newstarter = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM newstarters ORDER BY CR DESC');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$newstarter = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM newstarters')->fetchColumn();
}


?>
<head>
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">

</head>

<?=template_header('NewStarter')?>

<div class="content read">
	<h2>New Starter</h2>
	<a href="create-user.php" class="create-contact">Add New Starter</a>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table>
        <thead>
            <tr>
                <td>Task</td>
                <td>Name</td>
                <td>Email</td>
                <td>Manager</td>
                <td>CostCode</td>
                <td>Date</td>
                <td>Build</td>
                <td>NPS</td>
                <td>Laptop</td>
                <td>Bag</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newstarter as $newstarters): ?>
            <tr>
                <td><?=$newstarters['CR']?></td>
                <td><?=$newstarters['Name']?></td>
                <td><?=$newstarters['Email']?></td>
                <td><?=$newstarters['Manager']?></td>
                <td><?=$newstarters['CostCode']?></td>
                <td><?=$newstarters['Dated']?></td>
                <td><?=$newstarters['Build']?></td>
                <td><?=$newstarters['NPS']?></td>
                <td><?=$newstarters['Laptop']?></td>
                <td><?=$newstarters['Bag']?></td>
                <td class="actions">
                    <a href="update-user.php?CR=<?=$newstarters['CR']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
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