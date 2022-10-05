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
                include 'include/user_nav.php';
                if (isset($_POST['submit_sel'])) {
                    $_SESSION['search_val'] = $_POST['se_sel'];
                }
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View all users</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>User name</th>
                                        <th>user id</th>
                                        <th>Role</th>
                                        <th>Date</th>
                                        <th>Subscriber</th>
                                        <th>Gold</th>
                                        <th>Admin</th>
                                        <th>Delete</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_all_user = Post::qurey("SELECT * FROM users WHERE activate=1");
                                    while ($row = mysqli_fetch_assoc($select_all_user)) {
                                        $first_name = $row['first_name'];
                                        $second_name = $row['second_name'];
                                        $user_id = $row['email_id'];
                                        $role = $row['role'];
                                        $date = $row['date'];
                                        $id = $row['user_id'];
                                        echo " <tr>
                                        
                <td>$first_name $second_name</td>
                <td>$user_id</td>
                <td>$role</td>
                <td>$date</td>
                <td><a href='view_all_users.php?sub=$id''>Subscriber</a></td>
                <td><a href='view_all_users.php?gold=$id''>Gold</a></td>
                <td><a href='view_all_users.php?admin=$id''>Admin</a></td>
                <td><a href='view_all_users.php?user_id=$id'>Delete</a></td>
                </tr>";
                                    }
                                    if (isset($_GET['gold'])) {
                                        $gold_id = $_GET['gold'];
                                        $value = 'Gold';
                                        $gold_qurey = User::update_role($value, $gold_id);
                                        header('location:view_all_users.php');
                                    }
                                    if (isset($_GET['sub'])) {
                                        $sub_id = $_GET['sub'];
                                        $value = 'Subscriber';
                                        $sub_qurey = User::update_role($value, $sub_id);
                                        header('location:view_all_users.php');
                                    }
                                    if (isset($_GET['admin'])) {
                                        $admin_id = $_GET['admin'];
                                        $value = 'Admin';
                                        $admin_qurey = User::update_role($value, $admin_id);
                                        header('location:view_all_users.php');
                                    }
                                    if (isset($_GET['user_id'])) {
                                        $id = $_GET['user_id'];
                                        $delete = User::delete_user($id);
                                        header('location:otp_users.php');
                                    }
                                    ?>
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

</body>

</html>