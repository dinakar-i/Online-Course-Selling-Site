<?php include 'include/header.php' ?>

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
                <div class="container-fluid">

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total
                                                Users</div>
                                            <?php
                                            // include 'include/init.php';
                                            $user_count = POST::select_all_table('users');
                                            $total_count = mysqli_num_rows($user_count);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-user fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total
                                                Course</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    $total_post_count = POST::select_all_table('posts');
                                                    $post_count = mysqli_num_rows($total_post_count);
                                                    ?>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php echo $post_count ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width:<?php echo $post_count, '%'; ?>"
                                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                                            <i class="fas fa-photo-video fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Admin Counts</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $admin_qurey = POST::sel_table_by_title('users', 'role', 'Admin');
                                                        $admin_count = mysqli_num_rows($admin_qurey);
                                                        echo $admin_count;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                                            <!-- <i class="fa fa-map-pin fa-2x text-gray-300" aria-hidden="true"></i> -->
                                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Gold users
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $gold_qurey = POST::sel_table_by_title('users', 'role', 'Gold');
                                                        $gold_count = mysqli_num_rows($gold_qurey);
                                                        echo $gold_count;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                                            <!-- <i class="fa fa-map-pin fa-2x text-gray-300" aria-hidden="true"></i> -->
                                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Subscribers</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $Sub_qurey = POST::sel_table_by_title('users', 'role', 'Subscriber');
                                                        $sub_count = mysqli_num_rows($Sub_qurey);
                                                        echo $sub_count;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fab fa-accessible-icon fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Qustion Counts</div>
                                            <?php
                                            $commant = POST::select_all_table('question');
                                            $commant_count = mysqli_num_rows($commant);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $commant_count; ?></div>
                                        </div>
                                       
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                           
                                            <a href='status.php'><i class='far fa-question-circle fa-2x text-gray-300'></i></a>
                                        </div>
                                        <?php 
                                        $qus_auth=Post::sel_table_by_title('qus_authendicate','email',$_SESSION['username']);
                                        $qus_auth_count=mysqli_num_rows($qus_auth);
                                        if($qus_auth_count==0){
                                            echo "<i style='color:red;font-size:8px;margin-bottom:40px;' class='fas fa-circle'></i>";
                                        }
                                        ?>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total
                                                Reviwes</div>
                                            <?php
                                            // include 'include/init.php';
                                            $reviews_count = POST::select_all_table('reviews');
                                            $rev_count = mysqli_num_rows($reviews_count);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $rev_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-star-half-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <br>
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Story Views</div>
                                            <?php
                                            $feed = POST::select_all_table('feed_notify');
                                            $feed_count = mysqli_num_rows($feed);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $feed_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            <a href="#"><i onclick="pop_div()"
                                                    class="fab fa-studiovinari fa-2x text-gray-300"></i></a>
                                            <!-- <i class="far fa-question-circle fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><br>
                    <?php
                    $sel_table_views = POST::select_all_table('feed_notify');
                    $views_count = mysqli_num_rows($sel_table_views);
                    ?>
                    <div class="pop_detail">
                        <div class="head_bi">
                            <a href="#"> <i onclick="close_pop_div()"
                                    class="fas fa-long-arrow-alt-left back_arow"></i></a>
                            <h4
                                style="margin-left: 60px; top:10px;font-size:20px;position:absolute;font-family: 'Lemon', cursive;">
                                <?php echo $views_count; ?> Views</h4>
                        </div>
                        <br><br><br>
                        <?php
                        $sel_table_views = POST::select_all_table('feed_notify');
                        $views_count = mysqli_num_rows($sel_table_views);
                        while ($row_user = mysqli_fetch_assoc($sel_table_views)) {
                            $email_v = $row_user['email'];
                            $qurey_select_view = POST::sel_table_by_title('users', 'email_id', $email_v);
                            while ($row_views = mysqli_fetch_assoc($qurey_select_view)) {
                                $first_name = $row_views['first_name'];
                                $second_name = $row_views['second_name'];
                                $email_id = $row_views['email_id'];
                                echo "<h1 class='li_views'>$email_id  ($first_name $second_name)</h1>";
                            }
                        }

                        ?>

                    </div>
                    <script>
                    function pop_div() {
                        var pop_detail = document.querySelector('.pop_detail');

                        if (pop_detail.style.display == 'inline') {
                            pop_detail.style.display = 'none';
                        } else {
                            pop_detail.style.display = 'inline';
                        }
                    }

                    function close_pop_div() {
                        var pop_detail = document.querySelector('.pop_detail');
                        pop_detail.style.display = 'none';
                    }
                    </script>
                    <div id="columnchart_material" style="width:100%; height: 500px;"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
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