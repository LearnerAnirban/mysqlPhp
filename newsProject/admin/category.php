<?php 
    include "header.php"; 
    include "config.php";
    if($_SESSION['user_role'] != 1) {
        header("Location: {$hostname}/admin/post.php");
    }

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories </h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                            
                            if(isset($_GET['id'])) {
                                $page_num = $_GET['id'];
                            } else {
                                $page_num = 1;
                            }

                            $limit = 2;
                            $offset = ($page_num - 1) * $limit;
                            $sql = "SELECT * FROM category LIMIT $offset, $limit";
                            // var_dump($sql);
                            // die();
                            
                            $result = mysqli_query($conn, $sql) or die("Query Failed");

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $cat_id = $row['category_id'];
                                    $cat_name = $row['category_name'];
                                    $cat_post_count = $row['post'];

                            ?>
                        <tr>
                            <td class='id'><?php echo $cat_id; ?></td>
                            <td><?php echo $cat_name; ?></td>
                            <td><?php echo $cat_post_count; ?></td>
                            <td class='edit'><a href='update-category.php?cat_id=<?php echo $cat_id; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?cat_id=<?php echo $cat_id; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                            <?php 
                                    }
                                }
                            ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php

                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                        $total_cat = mysqli_num_rows($result1);
                        $total_page = ceil($total_cat / $limit);
                        if($page_num > 1) {
                            echo "<li><a href='category.php?id=" . ($page_num - 1) . "'>Prev</a></li>";
                        }
                        for($i = 1; $i <= $total_page; $i++ ) {
                    ?>
                            <!-- <li class="active"><a>1</a></li> -->
                            <li><a href="category.php?id=<?php echo $i; ?>"><?php echo $i;?></a></li>

                    <?php 
                        }
                        if($total_page > $page_num) {
                            echo "<li><a href='category.php?id=" . $page_num + 1 . "'>Next</a></li>";
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
