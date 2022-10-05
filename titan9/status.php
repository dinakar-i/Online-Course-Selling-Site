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
                <?php include 'include/post_nav.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View All Posts</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Iamge</th>
                                        <th>Passage</th>
                                        <th>Tags</th>
                                        <th>Recurments</th>
                                        <th>Contend</th>
                                        <th>Embed_codes</th>
                                        <th>Qustions</th>
                                        <th>Reviews</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $email_co=$_SESSION['username'];
                                    $code=Post::qurey("SELECT * FROM qus_authendicate WHERE email='$email_co'");
                                    $code_count=mysqli_num_rows($code);
                                    if($code_count==0){
                                        Post::qurey("INSERT into qus_authendicate (email) VALUE ('$email_co')");
                                    }
                                    $rule = Post::select_all_table('posts');
                                    while ($row = mysqli_fetch_assoc($rule)) {
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        $post_cat = $row['post_cat'];
                                        $post_date = $row['post_date'];
                                        $post_status = $row['status'];
                                        $post_img = $row['post_img'];
                                        $post_contend = $row['post_content'];
                                        $post_author = $row['post_author'];
                                        $post_commend = 20;

                                        echo  "<tr>
                <td>$post_id</td>
                <td>$post_title</td>  
                <td> <img  style='width:70px;'src='../course/assets/$post_img'></td>
                <td><a href='passage.php?post=$post_id'>Passage</a></td>
                <td><a href='tags.php?post=$post_id'>Tags</a></td>
                <td> <a href='recurments.php?post=$post_id'>Recurments</a></td>
                <td> <a href='contend.php?post=$post_id'>Contend</a></td>
                <td><a href='insert_code.php?post=$post_id'>Embed_code</a></td>";
               ?>
               <?php
               $qurey=Post::sel_ta_id('qus_notify','qus_post_id',$post_id);
               $count=mysqli_num_rows($qurey);
               if($count!=0){
                echo "<td><a href='qustions.php?q=$post_id'>Qustions</a><i style='color:red;font-size:6px;margin-bottom:40px;position:absolute;' class='fas fa-circle'></i></td>";
               }else{
                echo "<td><a href='qustions.php?q=$post_id'>Qustions</a></td>";
               }
                ?>
               <?php 
               echo "<td><a href='reviews.php?r=$post_id'>Reviews</a></td>
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


</body>

</html>