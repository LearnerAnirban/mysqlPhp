<?php
  // get post data with this method
  $stu_id = $_POST['sid'];
  $sname = $_POST['sname'];
  $saddress = $_POST['saddress'];
  $sclass = $_POST['sclass'];
  $sphone = $_POST['sphone'];

  // database connect
  $conn= mysqli_connect("localhost", "root", "", "php") or die("Datebase Connection Faild");

  // insert query to upload data
  $sql = "UPDATE student SET sname = '{$sname}', saddress = '{$saddress}', sclass = '{$sclass}', sphone = '{$sphone}' WHERE sid = '{$stu_id}' ";

  // Run query to execute some action
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

  // Redirect Url After Action Complete
  header("location: http://localhost/mysqlPhp/crud/index.php");

  // Connection Close
  mysqli_close($conn);
?>