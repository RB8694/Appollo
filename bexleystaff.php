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
$cmd = $pdo->prepare('SELECT * FROM bexstaff WHERE Name LIKE ? OR Email LIKE ? ORDER BY Email ASC');
$cmd->execute(["%".$_GET['search']."%", "%".$_GET['search']."%"]);
$staff = $cmd->fetchAll(PDO::FETCH_ASSOC);

}  
else {
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM bexstaff ORDER BY Email ASC');
//$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
//$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$staff = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_laptops = $pdo->query('SELECT COUNT(*) FROM bexstaff')->fetchColumn();
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
	<h2>Software</h2>
	<!-- <a href="create-app.php" class="create-contact">Add App</a> --><br><br><br><br>
    
    <form action="" method="GET">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <br></br>

	<table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staff as $staffs): ?>
            <tr>
                <td><?=$staffs['Name']?></td>
                <td><?=$staffs['Email']?></td>
                <td class="actions">
                    <a href="bexleystaff.php?Name=<?=$staffs['Name']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> 
                   <!-- <a href="delete.php?AppName=<?=$apps['AppName']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<footer>   
    <?php
    
    echo "<p>Copyright Robert Burt &copy; 2020-" . date("Y");
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