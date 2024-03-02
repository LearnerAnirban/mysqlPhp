
<div id="main-content">
    <h2>All Records</h2>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "php") or die("connection Faild");
    $sql = "SELECT * FROM student JOIN cstudent WHERE student.Roll = cstudent.sroll";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccesfull.");

    if(mysqli_num_rows($result) > 0) {

    ?>
    <table cellpadding="7px">
        <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Class</th>
        <th>Phone</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['Id'] ?></td>
                <td><?php echo $row['Name'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['Class'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td>
                    <a href='edit.php'>Edit</a>
                    <a href='delete-inline.php'>Delete</a>
                </td>
            </tr>
            <?php  } ?>
        </tbody>
    </table>

    <?php } else {
        echo "<h2>No Record Found</h2>";
    } 
    mysqli_close($conn);
    ?>

</div>
</div>
</body>
</html>
