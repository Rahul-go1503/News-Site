<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
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
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="admin/images/<?php echo $row['logo'] ?>"></a>
                </div>
                <!-- /LOGO -->
                <?php }
                } ?>
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>

                        <?php
                        include 'config.php';
                        if (isset($_GET['id'])) {

                            $cat_id = $_GET['id'];
                        } else {
                            $cat_id = 0;
                            $active = "active";
                        }
                        ?>
                        <li><a class="<?php echo $active ?>" href='index.php'>Home</a></li>
                        <?php
                        $sql = "SELECT * FROM category WHERE post >0";
                        $result = mysqli_query($conn, $sql) or die("QUERY FAILED.");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['category_id'] == $cat_id) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                        ?>
                                <li><a class="<?php echo $active ?>" href="category.php?id=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a></li>
                        <?php }
                        }
                        mysqli_close($conn);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->