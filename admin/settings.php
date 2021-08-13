<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                include 'config.php';
                $sql = "SELECT * FROM settings";
                $result = mysqli_query($conn, $sql) or die("QUERY FAILED.");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                
                ?>
                <!-- Form -->
                <form action="form-settings.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Company Name</label>
                        <input type="text" name="com_title" class="form-control" autocomplete="off" value="<?php echo $row['company_name'] ?>" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleInputPassword1">Company Logo</label>
                        <input type="file" name="new-logo">
                        <img src="images/<?php echo $row['logo'] ?>" height="100px">
                        <input type="hidden" name="old-logo" value="<?php echo $row['logo'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Footer Description</label>
                        <textarea name="footdesc" class="form-control" rows="5" required><?php echo $row['footerdesc'] ?></textarea>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>