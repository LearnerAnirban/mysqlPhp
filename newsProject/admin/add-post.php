<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                    include "config.php";
                    if(isset($_POST['submit'])) {
                        $post_title = $_POST['post_title'];
                        $post_description = $_POST['postdesc'];
                        $post_category = $_POST['category'];
                        $post_date = date("jS F Y");
                        $post_author = $_SESSION['user_role'];
                        $post_img = $_POST['fileToUpload'];
    
                        $sql = "INSERT INTO post title, description, category, post_date, author, post_img VALUES '{$post_title}', '{$post_description}', '{$post_category}', '{$post_date}', '{$post_author}', '{$post_img}'";
                        $result = mysqli_query($conn, $sql) or die("query Failed");
    
                        header("Location: {$hostname}/admin/post.php");
                    }

                ?>
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option value="" selected> Select Category</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
