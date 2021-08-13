<?php
include 'config.php';
$title = mysqli_real_escape_string($conn, $_POST['com_title']);
$description = mysqli_real_escape_string($conn, $_POST['footdesc']);

if (empty($_FILES['new-logo']['name'])) {
    $file_store = $_POST['old-logo'];
} else {
    $errors = array();
    $exe = array("jpeg", "jpg", "png");
    $filename = $_FILES['new-logo']['name'];
    $filesize = $_FILES['new-logo']['size'];
    $filetmpname = $_FILES['new-logo']['tmp_name'];
    $filetype = $_FILES['new-logo']['type'];
    $a = explode('.', $filename);
    $extension = end($a);

    if ($filesize > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }

    if (in_array($extension, $exe) === false) {
        $errors[] = "Please upload only in jpeg,jpg or png format";
    }

    if (empty($errors) == true) {
        $file_name = time()."-". basename($filename);
        $file_store = $file_name;
        move_uploaded_file($filetmpname, "images/$file_name");
    } else {
        print_r($errors);
        die();
    }
}


$sql = "UPDATE settings SET company_name='{$title}',footerdesc='{$description}',logo='{$file_store}'";

if (mysqli_query($conn, $sql)) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed...</div>";
}
