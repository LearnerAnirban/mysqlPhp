<?php 
include 'config.php';
$userId = $_POST['user_id'];
$fname = $_POST['f_name'];
$lname = $_POST['l_name'];
$userName = $_POST['username'];
$role = $_POST['role'];

$sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$userName}', role = '{$role}' WHERE id = '{$userId}'";

$result = mysqli_query($conn, $sql);

header("Location: $hostname/admin/users.php");
mysqli_close($conn);
?>