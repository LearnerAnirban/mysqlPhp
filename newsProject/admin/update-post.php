<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
            include "config.php";
            $post_id = $_GET['id'];
            if(isset($_POST['submit'])) {

                if(empty($_FILES['new-image'] ['name'])) {
                    $file_name = $_POST['old-image'];
                } else {
                    $file_name = $_FILES['new-image'] ['name'];
                    $file_type = $_FILES['new-image'] ['type'];
                    $file_tmp = $_FILES['new-image'] ['tmp_name'];
                    $file_size = $_FILES['new-image'] ['size'];
                    $file_path = "upload/" . $file_name;
                    if(move_uploaded_file($file_tmp, $file_path)) {
                        echo "file Uploaded";
                    } else {
                        echo "Upload Faild";
                    }
                }


                $post_tilte = $_POST['post_title'];
                $post_des = $_POST['postdesc'];
                $post_cat = $_POST['category'];
                $post_date = date("jS F Y");
                
                $sql1 = "UPDATE post SET title = '{$post_tilte}', description = '{$post_des}', category = '{$post_cat}', post_date = '{$post_date}', post_img = '{$file_name}' WHERE post_id = {$post_id}";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                header("Location: {$hostname}/admin/post.php");
            }


            $sql = "SELECT * FROM post WHERE post_id = {$post_id}";
            $result = mysqli_query($conn, $sql) or die("Query Failed");

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {



        ?>
        <!-- Form for show edit-->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="<?php echo $row['post_id']; ?>"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $row['title']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php 
                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                        if(mysqli_num_rows($result1) > 0) {
                            while($row1 = mysqli_fetch_assoc($result1)) {
                    ?>
                        <option <?php echo $row['category'] == $row1['category_id'] ? "selected" : ""; ?> value="<?php echo $row1['category_id']; ?>"><?php echo $row1['category_name']; ?></option>
                    <?php 
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image" value="">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php 
                }
            }
        ?>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
