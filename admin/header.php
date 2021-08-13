<?php
include 'config.php';
session_start();

if (!isset($_SESSION["username"])) {

    header("Location: {$hostname}/admin/error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <?php
                include 'config.php';
                $sql = "SELECT * FROM settings";
                $result = mysqli_query($conn, $sql) or die("QUERY FAILED.");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <!-- LOGO -->
                        <div class="col-md-2">
                            <a href="../index.php"><img class="logo" src="images/<?php echo $row['logo'] ?>"></a>
                        </div>
                        <!-- /LOGO -->
                <?php }
                } ?>
                <!-- LOG-Out -->
                <div class="col-md-offset-9  col-md-1">
                    <span class="text-white"><?php echo 'Hii ' . $_SESSION['username'] ?></span>
                    <a href="logout.php" class="admin-logout">logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>

                        <?php
                        if ($_SESSION['role'] == 1) {
                        ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="settings.php">Settings</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->