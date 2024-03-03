<?php
// get post data with this method
$sname = $_POST['sname'];
$saddress = $_POST['saddress'];
$sclass = $_POST['class'];
$sphone = $_POST['sphone'];

// database connect
$conn= mysqli_connect("localhost", "root", "", "php") or die("Datebase Connection Faild");
// insert query to upload data
$sql = ("INSERT INTO student(sname, saddress, sclass, sphone) VALUES ( '{$sname}', '{$saddress}' , '{$sclass}' , '{$sphone}')" );
// Run query to execute some action
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

header("Location: http://localhost/mysqlPhp/crud/index.php");
mysqli_close($conn);

?>