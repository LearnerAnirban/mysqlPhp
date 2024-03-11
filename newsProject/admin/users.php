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
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php
                        include 'config.php';
                        $limit = 5;

                        if(isset($_GET['page'])) {
                            $page = $_GET['page'];

                        } else {
                            $page = 1;
                        }

                        $offset = ($page - 1) * $limit;

                        $sql = "SELECT * FROM user LIMIT $offset, $limit";
                        $result = mysqli_query($conn, $sql) or die("Query Failed");
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                if($row['role'] == 1) {
                                    $role = 'admin';
                                } else {
                                    $role = 'editor';
                                }


                        ?>
                          <tr>
                              <td class='id'><?php echo $row['id'] ?></td>
                              <td><?php echo $row['first_name'] ." " . $row['last_name'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td><?php echo $role ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php 
                                }
                            } ?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                    <?php
                        if($page > 1) {
                            echo '<li><a href="users.php?page='. ($page - 1) .'">Prev</a></li>';
                        }

                        $sql1 = "SELECT * FROM user";
                        $result1 = mysqli_query($conn, $sql1);
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);
                        for($i = 1; $i <= $total_page; $i++) {

                    ?>
                      <li class='<?php
                        if($page == $i) {
                            echo "active";
                        }
                      ?>'><a href="users.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                        };
                        if($total_page > $page) {
                            echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                        }
                        
                    ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
