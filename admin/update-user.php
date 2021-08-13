<?php include "header.php";
if($_SESSION['role']==0){
    header("Location: {$hostname}/admin/post.php");
}
$user_id = $_GET['id'];
include 'config.php';

if (isset($_POST['submit'])) {

    $user_fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $user_lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $user_user = mysqli_real_escape_string($conn, $_POST['username']);
    $user_role = mysqli_real_escape_string($conn, $_POST['role']);
    $user_id1 = mysqli_real_escape_string($conn, $_POST['user_id']);

    $sql = "SELECT username FROM user WHERE username ='{$user_user}'";
    $result = mysqli_query($conn, $sql) or die("QUERY FAILED.");
    if (mysqli_num_rows($result) > 1) {
        echo "<p style='color:red;text-align:center;margin:10px 0;'>User Name already Exists</p>";
    } else {
        $sql1 = "UPDATE user SET first_name= '{$user_fname}', last_name='{$user_lname}',username='{$user_user}',role='{$user_role}' WHERE user_id='{$user_id1}'";
        mysqli_query($conn, $sql1) or die("Query Unsucessfull");
        header("Location: {$hostname}/admin/users.php");
    }
    mysqli_close($conn);
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                $sql2 = "SELECT * FROM user WHERE user_id='{$user_id}'";
                $result2 = mysqli_query($conn, $sql2) or die("Query Unsucessfull");
                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        
                        ?>
                        <!-- Form Start -->
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <?php
                                echo '<select class="form-control" name="role">"';

                                if ($row['role'] == 1) {
                                    echo "<option selected value='1'>admin</option>";
                                    echo "<option value='0'>user</option>";
                                } else {
                                    echo "<option value='1'>admin</option>";
                                    echo "<option selected value='0'>user</option>";
                                }

                                echo "</select>";
                                ?>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php }
                } ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>