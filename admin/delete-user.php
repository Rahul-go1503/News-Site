<?php
if($_SESSION['role']==0){
    header("Location: {$hostname}/admin/error.php");
}
$user_id = $_GET['id'];
include 'config.php';
$sql = "DELETE FROM user WHERE user_id= {$user_id}";

$result = mysqli_query($conn, $sql) or die("Query Unsuccessfull.");
header("Location: {$hostname}/admin/users.php");
mysqli_close($conn);
?>
