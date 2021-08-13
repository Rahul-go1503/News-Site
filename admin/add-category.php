<?php include "header.php"; 
if($_SESSION['role']==0){
    header("Location: {$hostname}/admin/error.php");
}
if (isset($_POST['save'])){
    include 'config.php';
    $cat=$_POST['cat'];
    $sql="SELECT category_name FROM category WHERE category_name ='{$cat}'";
    $result= mysqli_query($conn,$sql)or die("QUERY FAILED.");
     if(mysqli_num_rows($result)>0){
        echo "<p style='color:red;text-align:center;margin:10px 0;'>Category Name already Exists</p>";
    }
    else{
        $sql1 = "INSERT INTO category (category_name) VALUES ('{$cat}')";
    mysqli_query($conn, $sql1) or die("Query Unsucessfull");
    header("Location: {$hostname}/admin/category.php");
    }

    
    mysqli_close($conn);
     }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
