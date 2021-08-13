<?php include "header.php"; 
if($_SESSION['role']==0){
    header("Location: {$hostname}/admin/error.php");
}
$catgory_id = $_GET['id'];
include 'config.php';

if (isset($_POST['submit'])) {
    $cat_id=$_POST['cat_id'];
    $cat_name=$_POST['cat_name'];
    $sql = "UPDATE category SET category_name='{$cat_name}' WHERE category_id='{$cat_id}' ";
    $result = mysqli_query($conn, $sql) or die("QUERY FAILED.");
    header("Location: {$hostname}/admin/category.php");
    mysqli_close($conn);
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                $sql2 = "SELECT * FROM category WHERE category_id='{$catgory_id}'";
                $result2 = mysqli_query($conn, $sql2) or die("Query Unsucessfull");
                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {

                ?>
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }
                } ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
