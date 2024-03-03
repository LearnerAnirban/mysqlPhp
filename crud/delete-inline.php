<?php
$stu_id = $_GET['id'];
 // database connect
 $conn= mysqli_connect("localhost", "root", "", "php") or die("Datebase Connection Faild");

 // insert query to upload data
 $sql = "DELETE FROM student WHERE sid = {$stu_id}";

 // Run query to execute some action
 $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

 // Redirect Url After Action Complete
 header("location: http://localhost/mysqlPhp/crud/index.php");

 // Connection Close
 mysqli_close($conn);
?>
