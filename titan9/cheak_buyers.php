<?php
ob_start();
include 'include/header.php';
// include '../include/init.php'; 
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
                <?php
                //  include 'include/nav_bar.php'; 
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Content Row -->

                        <div class="row">

                            <!-- Area Chart -->
                            <div class="col-xl-6 col-lg-6" style="height: 200px;">
                                <br>
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">INSERT USERS</h6>

                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <form action="cheak_buyers.php" method="post">
                                            <!-- <label for="cat-title">Add Categories:  </label> -->
                                            <input type="text" class="form-control" name="cat_title"><br>
                                            <input type="submit" class="btn btn-primary" value="submit" name="submit">
                                        </form>
                                        <?php if (isset($_POST['submit'])) {
                                            $cat_title = $_POST['cat_title'];
                                            header("location:cheak_buyers.php?u=$cat_title");
                                        }

                                        ?>
                                    </div>

                                </div>

                            </div>


                            <div class="col-xl-6 col-lg-6   ">
                                <br>
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Buyers</h6>
                                        <div class="dropdown no-arrow">
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Users</th>
                                                    <th>Post title</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['u'])) {
                                                    $id = $_GET['u'];
                                                    $cat_qurey = Post::sel_table_by_title('payments', 'email_id', $id);
                                                    $buy_count = mysqli_num_rows($cat_qurey);
                                                    if ($buy_count > 0) {
                                                        while ($row = mysqli_fetch_assoc($cat_qurey)) {
                                                            $payment_id = $row['payment_id'];
                                                            $email_id = $row['email_id'];
                                                            $post_title = $row['post_title'];
                                                            echo "<tr>
                <td>$email_id</td>
                <td>$post_title</td>
                <td><a href='cheak_buyers.php?del=$payment_id'>Delete</a></td> ";
                                                        }
                                                    } else {
                                                        echo "<tr>
                                                        <td>NO</td>
                                                        <td>No</td>
                                                        <td><a href='#'>NO</a></td> ";
                                                    }
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['del'])) {
            $del_id = $_GET['del'];
            $del = Post::qurey("DELETE FROM payments WHERE payment_id=$del_id");
            header("location:cheak_buyers.php");
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

</body>

</html>