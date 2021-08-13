<?php
include 'config.php';
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

if (empty($_FILES['new-image']['name'])) {
    $filename = $_POST['old-image'];
} else {
    $errors = array();
    $exe = array("jpeg", "jpg", "png");
    $filename = $_FILES['new-image']['name'];
    $filesize = $_FILES['new-image']['size'];
    $filetmpname = $_FILES['new-image']['tmp_name'];
    $filetype = $_FILES['new-image']['type'];
    $a = explode('.', $filename);
    $extension = end($a);

    if ($filesize > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }

    if (in_array($extension, $exe) === false) {
        $errors[] = "Please upload only in jpeg,jpg or png format";
    }

    if (empty($errors) == true) {
        $file_name = basename($filename) . "-" . time();
        $file_store = $file_name;
        move_uploaded_file($filetmpname, "upload/$file_name");
    } else {
        print_r($errors);
        die();
    }
}


$sql = "UPDATE post SET title='{$title}',description='{$description}',category={$category},post_img='{$file_store}'
WHERE post_id={$_POST["post_id"]};";
if ($_POST['old_category'] != $_POST["category"]) {
    $sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$_POST['old_category']};";
    $sql .= "UPDATE category SET post= post + 1 WHERE category_id = {$_POST["category"]};";
}

if (mysqli_multi_query($conn, $sql)) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed...</div>";
}
