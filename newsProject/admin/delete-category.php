<?php
include 'config.php';
$cat_id = $_GET['cat_id'];

$sql = "DELETE FROM category WHERE category_id = '{$cat_id}'";
$result = mysqli_query($conn, $sql) or die("connect failed");

header("Location: $hostname/admin/category.php");
mysqli_close($conn);



?>