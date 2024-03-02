<?php
$sname = $_POST['sname'];
$saddress = $_POST['saddress'];
$sclass = $_POST['class'];
$sphone = $_POST['sphone'];


$conn= mysqli_connect("localhost", "root", "", "php") or die("Datebase Connection Faild");
$sql = ("INSERT INTO student(Name, address) VALUES ( '{$sname}', '{$saddress}')" );
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");







?>