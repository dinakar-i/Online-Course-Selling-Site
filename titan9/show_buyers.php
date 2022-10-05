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
                <br><br>
                <?php
                if (isset($_GET['post'])) {
                    $post_id = $_GET['post'];
                }
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
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Add custom Users</h6>

                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <form method="post">
                                            <!-- <label for="cat-title">Add Categories:  </label> -->
                                            <input type="text" class="form-control" name="email_id"><br>
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">


                                        </form>
                                        <?php

                                        if (isset($_POST['submit'])) {
                                            $email_id = $_POST['email_id'];
                                            if ($email_id != '') {
                                                $post_id = $_GET['post'];
                                                $select_post_query = POST::sel_table_by_id('posts', 'post_id', $post_id);
                                                $fetch_post_qurey = mysqli_fetch_assoc($select_post_query);
                                                $post_title = $fetch_post_qurey['post_title'];
                                                $post_price = $fetch_post_qurey['post_price'];
                                                $post_img = $fetch_post_qurey['post_img'];
                                                $post_content = $fetch_post_qurey['post_content'];
                                                $selct_full_name = POST::sel_table_by_title('users', 'email_id', $email_id);
                                                $user_fetch = mysqli_fetch_assoc($selct_full_name);
                                                $first_name = $user_fetch['first_name'];
                                                $second_name = $user_fetch['second_name'];
                                                $full_name = $first_name . '' . $second_name;
                                                $date = date('d-m-y');
                                                if ($email_id !== '') {
                                                    $update = Post::qurey("INSERT INTO payments (payment_post_id,post_title,price,email_id,full_name,post_img,content,date) VALUES ($post_id,'$post_title','$post_price','$email_id','$full_name','$post_img','$post_content','$date')");
                                                    header("location:show_buyers.php?post=$post_id");
                                                }
                                            }
                                        }

                                        ?>
                                    </div>

                                </div>

                            </div>


                            <div class="col-xl-6 col-lg-6   ">
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
                                                    <th>Title</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['post'])) {
                                                    $post_id = $_GET['post'];
                                                    $cat_qurey = Post::qurey("SELECT * FROM payments WHERE payment_post_id=$post_id");
                                                    while ($row = mysqli_fetch_assoc($cat_qurey)) {
                                                        $payment_id = $row['payment_id'];
                                                        $payment_post_id = $row['payment_post_id'];
                                                        $post_title = $row['post_title'];
                                                        $email = $row['email_id'];
                                                        echo "<tr>
                <td>$post_title</td>
                <td>$email</td>
                <td><a style='text-decoration:none;' href='show_buyers.php?delete=$payment_post_id'>Delete</a></td> ";
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
        if (isset($_GET['delete'])) {
            $del_id = $_GET['delete'];
            $sel_pay_id = POST::sel_table_by_id('payments', 'payment_post_id', $del_id);
            $sel_id_fetch = mysqli_fetch_assoc($sel_pay_id);
            $del_post_id = $sel_id_fetch['payment_id'];
            $del = Post::qurey("DELETE FROM payments WHERE payment_id=$del_post_id");
            if ($del == true) {
                header("location:show_buyers.php?post=$del_id");
            }
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