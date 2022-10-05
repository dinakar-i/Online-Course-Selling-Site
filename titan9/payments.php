<?php
ob_start();
include 'include/header.php';
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
                <?php include 'include/payment_nav.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View All Payments</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>price</th>
                                        <th>Image</th>
                                        <th>Buyers Count</th>
                                        <th>Show Buyers</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rule = Post::select_all_table('posts');
                                    while ($row = mysqli_fetch_assoc($rule)) {
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        $post_cat = $row['post_cat'];
                                        $post_date = $row['post_date'];
                                        $post_status = $row['status'];
                                        $post_img = $row['post_img'];
                                        $post_contend = $row['post_content'];
                                        $post_price = $row['post_price'];
                                        $post_author = $row['post_author'];
                                        $post_commend = POST::sel_table_by_id('question', 'qus_post_id', $post_id);
                                        $ques_count = mysqli_num_rows($post_commend);
                                        $buyers_qurey = POST::sel_table_by_id('payments', 'payment_post_id', $post_id);
                                        $buyers_count = mysqli_num_rows($buyers_qurey);
                                        echo  "<tr>
                <td>$post_id</td>
                <td>$post_title</td>";
                                        if ($post_price == 0) {
                                            echo "<td>Free</td>";
                                        } else {
                                            echo "<td>$post_price</td>";
                                        }
                                        echo "<td> <img  style='width:70px;'src='../course/assets/$post_img'></> 
                <td>$buyers_count</td>
                <td><a style='text-decoration:none;' href='show_buyers.php?post=$post_id'>Show buyers</a></td>           
                 </tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <?php
        if (isset($_GET['g'])) {
            $post_id = $_GET['g'];
            $update = POST::update_status('publish', $post_id);
            header('location:view_all_post.php');
        }
        if (isset($_GET['z'])) {
            $post_id = $_GET['z'];
            $update = POST::update_status('unpublish', $post_id);
            header('location:view_all_post.php');
        }
        ?>
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