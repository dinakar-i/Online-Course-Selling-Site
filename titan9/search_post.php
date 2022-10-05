<?php
ob_start();
include 'include/header.php';
// include 'include/init.php'; 
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'include/saide_bar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include 'include/post_nav.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View search Posts</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>price</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>tags</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                  $search = $_POST['search'];
                  if ($search == '') {
                    header('location:view_all_post.php');
                  }
                  $rule = Post::search_fun('posts', 'post_title', $search);
                  while ($row = mysqli_fetch_assoc($rule)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_cat = $row['post_cat'];
                    $post_date = $row['post_date'];
                    $post_status = $row['status'];
                    $post_img = $row['post_img'];
                    $post_contend = $row['post_content'];
                    // $post_re = $row['Recurments'];
                    $post_price = $row['post_price'];
                    $post_author = $row['post_author'];
                    $post_commend = 20;

                    echo  "<tr>
                <td>$post_id</td>
                <td>$post_author</td>
                <td>$post_title</td>
                <td>$post_price</td>
                <td>$post_cat</td>
                <td>$post_status</td>
                <td> <img  style='width:70px;'src='../course/assets/$post_img'></td>
                <td>$post_commend</td>
                <td>$post_date</td>
                <td><a href='tags.php?post=$post_id'>tags</a></td>
                <td><a href='edit_post.php?post_id=$post_id'>Edit</a></td>
                <td><a href='view_all_post.php?del=$post_id'>Delete</a></td>                
                 </tr>";
                  } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <!-- Scroll to Top Button-->
        <!-- Logout Modal-->
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <?php
    if (isset($_GET['del'])) {
      $del = $_GET['del'];
      $result = Post::delete('posts', 'post_id', $del);
      header('location:view_all_post.php');
    }
    ?>

</body>

</html>