<!-- Alert Box require -->
<?php
if($_SESSION['role']==0){
    header("Location: {$hostname}/admin/error.php");
}
$cat_id = $_GET['id'];
include 'config.php';
$sql = "DELETE FROM category WHERE category_id= {$cat_id}";

$result = mysqli_query($conn, $sql) or die("Query Unsuccessfull.");
header("Location: {$hostname}/admin/category.php");
mysqli_close($conn);
?>