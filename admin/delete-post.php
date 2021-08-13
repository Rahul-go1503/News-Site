<?php
$post_id = $_GET['id'];
$cat_id=$_GET['cid'];
include 'config.php';

$sql1="SELECT * FROM post WHERE post_id={$post_id}";
$result1=mysqli_query($conn,$sql1)or die("Query failed");
$row1=mysqli_fetch_assoc($result1);
unlink("upload/".$row1['post_img']);

$sql = "DELETE FROM post WHERE post_id= {$post_id};";
$sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$cat_id}";
$result = mysqli_multi_query($conn, $sql) or die("Query Unsuccessfull.");
header("Location: {$hostname}/admin/post.php");
mysqli_close($conn);
