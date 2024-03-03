<?php include 'header.php'; ?>
<?php

if(isset($_POST['deletebtn'])) {

    // database connect
    $conn= mysqli_connect("localhost", "root", "", "php") or die("Datebase Connection Faild");
    $stu_id = $_POST['sid'];
    // insert query to upload data
    $sql = "DELETE FROM student WHERE sid = {$stu_id}";

    // Run query to execute some action
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

    // Redirect Url After Action Complete
    header("location: http://localhost/mysqlPhp/crud/index.php");

    // Connection Close
    mysqli_close($conn);
}

?>

<div id="main-content">
    <h2>Delete Record</h2>
    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="deletebtn" value="Delete" />
    </form>
</div>
</div>
</body>
</html>
