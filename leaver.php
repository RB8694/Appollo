<?php
session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();

$server = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$db = 'asset';

$con = mysqli_connect($server, $dbuser, $dbpassword, $db);

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


if (isset($_GET['search'])) {
$cmd = $pdo->prepare('SELECT * FROM leavers WHERE CR_No LIKE ? OR Email LIKE ? OR Name LIKE ? OR Dated LIKE ? ORDER BY Dated DESC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%", "%".$_GET['search']."%"]);
$leaver = $cmd->fetchAll(PDO::FETCH_ASSOC);



}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM leavers ORDER BY CR_No DESC');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$leaver = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM leavers')->fetchColumn();
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

<?=template_header('Read')?>

<div class="content read">
	<h2>Leaver</h2>
	<a href="create-leaver.php" class="create-contact">Add Leaver</a>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table class="a" style="width:1200px">
        <thead>
            <tr>
                <td>Task No</td>
                <td style="width:300px";>Name</td>
                <td style="width:400px";>Email</td>
                <td>Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leaver as $leavers): ?>
            <tr>
                <td><?=$leavers['CR_No']?></td>
                <td><?=$leavers['Name']?></td>
                <td><?=$leavers['Email']?></td>
                <td><?=$leavers['Dated']?></td>
                <td class="actions">
                  <!--   <a href="update-user.php?CR_No=<?=$leavers['CR_No']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
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