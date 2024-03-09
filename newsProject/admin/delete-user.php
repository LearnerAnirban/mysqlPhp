<?php 
include 'config.php';
$userId = $_GET['id'];
$sql = "DELETE FROM user WHERE id = '{$userId}' ";

$result = mysqli_query($conn, $sql);

header("Location: http://localhost/mysqlPhp/newsProject/admin/users.php");
mysqli_close($conn);
?>