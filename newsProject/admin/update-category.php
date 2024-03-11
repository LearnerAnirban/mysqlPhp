<?php 
    include "header.php"; 
    include "config.php";
    if($_SESSION['user_role'] != 1) {
        header("Location: {$hostname}/admin/post.php");
    }
    $cat_id = $_GET['cat_id'];
    $sql = "SELECT * FROM category WHERE category_id = '{$cat_id}'";
    $result = mysqli_query($conn, $sql) or die("Query failed");
    if($row = mysqli_fetch_assoc($result)) {
        $cat_name = $row['category_name'];
    }
    if(isset($_POST['submit'])) {
        $category_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
        $sql1 = "UPDATE category SET category_name = '{$category_name}' WHERE category_id = '{$cat_id}'";
        $result1 = mysqli_query($conn, $sql1) or die("Query failed");

        header("Location: {$hostname}/admin/category.php");
    }






?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php $cat_id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $cat_name; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
