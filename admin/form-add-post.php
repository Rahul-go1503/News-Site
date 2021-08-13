<!-- ~~`~~REQUIRED MODIFICATION~~`~~ -->

<?php
include 'config.php';
session_start();
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION["user_id"];

if (isset($_FILES)) {
    $errors = array();
    $exe = array("jpeg","jpg", "png");
    $filename = $_FILES['fileToUpload']['name'];
    $filesize = $_FILES['fileToUpload']['size'];
    $filetmpname = $_FILES['fileToUpload']['tmp_name'];
    $filetype = $_FILES['fileToUpload']['type'];
    $extension = end(explode('.',$filename));


    if ($filesize > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }

    // if($filesize > 2097152‬){
    //     $errors[] = "File size must be 2mb or lower.";
    //   }  ~~REALLY I CAN'T UNDERSTAND WHY HERE SHOWS ERROR WHILE SAME LINE WHEN I COPY FROM OTHER FILE WORK PROPARLY

    if (in_array($extension, $exe)===false) {
        $errors[] = "Please upload only in jpeg,jpg or png format";
    }

    if (empty($errors)==true) {
        $file_name=time()."-". basename($filename);
        $file_store=$file_name;
        move_uploaded_file($filetmpname, "upload/$file_name");
    } else {
        print_r($errors);
        die();
    }


    $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('{$title}','{$description}',{$category},'{$date}',{$author}, '{$file_store}');";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

    if (mysqli_multi_query($conn, $sql)) {
        header("location: {$hostname}/admin/post.php");
    } else {
        echo "<div class='alert alert-danger'>Query Failed...</div>";
    }
}
