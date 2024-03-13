<?php
  include "config.php";
  session_start();
  if(isset($_POST['submit'])) {
    if($_FILES['fileToUpload']) {
      $file_name = $_FILES['fileToUpload'] ['name'];
      $file_type = $_FILES['fileToUpload'] ['type'];
      $file_tmp = $_FILES['fileToUpload'] ['tmp_name'];
      $file_size = $_FILES['fileToUpload'] ['size'];
      $img_path = "upload/" . $file_name;
      if(move_uploaded_file($file_tmp, $img_path)) {
        echo "echo successful";
      } else {
        echo "Upload Failed";
      }
    }
    $post_title = $_POST['post_title'];
    $post_description = $_POST['postdesc'];
    $post_category = $_POST['category'];
    $post_date = date("j F Y");
    $post_author = $_SESSION['user_role'];
    
    $sql = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES ('{$post_title}', '{$post_description}', '{$post_category}', '{$post_date}', '{$post_author}', '{$file_name}')";
    $result = mysqli_query($conn, $sql) or die("query Failed");
    
    header("Location: {$hostname}/admin/post.php");
  }

?>