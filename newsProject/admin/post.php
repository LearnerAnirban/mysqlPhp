<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                            include "config.php";
                            $limit = 3;
                            if(isset($_GET['id'])) {
                                $page_id = $_GET['id'];
                            } else {
                                $page_id = 1;
                            }
                            $ofset = ($page_id -1) * $limit;
                            if($_SESSION['user_role'] == 1) {
                                $sql = "SELECT * FROM post
                                LEFT JOIN category ON post.category = category.category_id
                                LEFT JOIN user ON post.author = user.id
                                LIMIT $ofset, $limit";
                            } else if($_SESSION['user_role'] == 0) {
                                $sql = "SELECT * FROM post
                                LEFT JOIN category ON post.category = category.category_id
                                LEFT JOIN user ON post.author = user.id
                                WHERE post.author = {$_SESSION['user_id']}
                                LIMIT $ofset, $limit";
                            } else {

                            }

                            $result = mysqli_query($conn, $sql) or die("Query Failed");
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    // $role = $_SESSION['user_role'];
                                    // if($role == 1) {
                                    //     $role_text =  "Admin";
                                    // } else {
                                    //     $role_text = "Editor";
                                    // }


                        ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                                }
                            }
                          ?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>

                    <?php 
                        if($page_id > 1) {
                            echo '<li><a href="post.php?id=' . $page_id - 1 . '">Prev</a></li>';
                        }
                        $sql1 = "SELECT * FROM post WHERE post.author = {$_SESSION['user_id']}";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                        $total_post = mysqli_num_rows($result1);
                        $total_page = ceil($total_post / $limit);

                        for($i = 1; $i <= $total_page; $i++) {
                    ?>
                      <li><a href="post.php?id=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php  
                        }
                        if($page_id < $total_page) {
                            echo '<li><a href="post.php?id=' . $page_id + 1 . '">Prev</a></li>';
                        }
                    ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
