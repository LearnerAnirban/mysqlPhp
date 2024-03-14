<?php
  include "config.php";
  session_start();
  if(isset($_POST['submit'])) {
    if($_FILES['fileToUpload']) {
      $file_name = $_FILES['fileToUpload'] ['name'];
      $file_type = $_FILES['fileToUpload'] ['type'];
      $file_tmp = $_FILES['fileToUpload'] ['tmp_name'];
      $file_size = $_FILES['fileToUpload'] ['size'];
      $ext = end(explode('.', $file_name));
      $file_ext = ['jpge', 'jpg', 'png', 'gif', 'svg', 'webp'];
      $img_path = "upload/" . $file_name;
      $error = array();
      
      if(in_array($ext, $file_ext) === false) {
        $error[] = "Please Upload Only jpge, jpg, png, gif, svg, webp";
      }
      if(($file_size < 5000) === false) {
        $error[] = "Pease upload file less then 5MB";
      }

      if(move_uploaded_file($file_tmp, $img_path)) {
        $error[] = "echo successful";
      } else {
        $error[] = "Upload Failed";
      }
    }
    $post_title = $_POST['post_title'];
    $post_description = $_POST['postdesc'];
    $post_category = $_POST['category'];
    $post_date = date("j F Y");
    $post_author = $_SESSION['user_id'];
    
    $sql = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES ('{$post_title}', '{$post_description}', '{$post_category}', '{$post_date}', '{$post_author}', '{$file_name}');";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$post_category}";
    
    if(mysqli_multi_query($conn, $sql)) {
        header("Location: {$hostname}/admin/post.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
  }

?>