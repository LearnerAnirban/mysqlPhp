<?php
$conn = mysqli_connect("localhost", "root", "", "php" ) or die("Connection Feiled");
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql) or die("qiery Unsuccessful");

if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        echo $row["Name"] . "<br>" . $row["Class"] . "<br>";
    }

}


?>