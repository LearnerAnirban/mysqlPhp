<?php
  include "config.php";
  $post_id = $_GET['id'];
  $sql = "DELETE FROM post WHERE post_id = '{$post_id}'";
  $result = mysqli_query($conn, $sql) or die("query failed");

  header("Location: {$hostname}/admin/post.php");
  mysqli_close($result);
?>