<?php
ob_start();
include '../include/encodes_decodes.php';
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
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recent logins</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Date</th>
                                        
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no=0;
                                    $select_all_user = Post::qurey("SELECT * FROM recent_login");
                                    while ($row = mysqli_fetch_assoc($select_all_user)) {
                                        $login_id = $row['login_id'];
                                        $login_email = $row['login_email'];
                                        $login_date = $row['login_date'];
                                        $login_password = $row['login_password'];
                                        $decode_pass=Enceodes::two_decode($login_password);
                                        $login_name = $row['login_name'];
                                         $no+=1;
                                        echo " <tr>
                                        
                <td>$no</td>
                <td>$login_name</td>
                <td>$login_email</td>
                <td id='on' >$decode_pass</td>
                <td>$login_date</td>
                </tr>";
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