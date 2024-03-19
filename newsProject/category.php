<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                        $cat_id = $_GET['cat_id'];
                        $sql1 = "SELECT * FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        WHERE category = {$cat_id}";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                        $row1 = mysqli_fetch_assoc($result1);
                    ?>
                  <h2 class="page-heading"><?php echo $row1['category_name']; ?></h2>
                    <?php
                        include "./admin/config.php";
                        if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        

                        $limit = 3;
                        $ofset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON  post.author = user.id WHERE category = {$cat_id} LIMIT $ofset, $limit";
                        $result = mysqli_query($conn, $sql) or die("Query Failed");
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {


                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cat_id=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['id']; ?>'><?php echo $row['username']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($row['description'], 0, 120) . "..."; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                            }

                        }
                    ?>
                    <ul class='pagination'>
                        <?php 
                            $total_post = mysqli_num_rows($result1);

                            if($page > 1) {
                        ?>
                                <li><a href="category.php?page=<?php echo $page - 1 ?>&cat_id=<?php echo $row1['category'] ?>">Prev</a></li>
                        <?php 
                            }

                            
                            $total_page = $total_post / $limit;

                            for($i = 1; $i <= $total_page; $i++) {
                        ?>
                            <li class = '<?php echo $page == $i ? "active" : "" ?>'><a href="category.php?page=<?php echo $i ?>&cat_id=<?php echo $row1['category'] ?>"><?php echo $i ?></a></li>
                        <?php 
                            }
                            if($total_page > $page) {
                        ?>
                                <li><a href="category.php?page=<?php echo $page + 1 ?>&cat_id=<?php echo $row1['category'] ?>">Next</a></li>
                        <?php 
                            }
                        ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
