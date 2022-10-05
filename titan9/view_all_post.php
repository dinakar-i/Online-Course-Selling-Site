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
                <?php include 'include/post_nav.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View All Posts</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['selectBox'])) {
                                foreach ($_POST['selectBox'] as $PostIdvalue) {
                                    $option_select = $_POST['options'];
                                    if($option_select==0){
                                    $query = POST::qurey("UPDATE posts SET post_price='$option_select' WHERE post_id=$PostIdvalue");
                                    $query1 = POST::qurey("UPDATE posts SET post_cat='Free Courses' WHERE post_id=$PostIdvalue");
                                     header('location:view_all_post.php');
                                    }else{
                                        $query = POST::qurey("UPDATE posts SET post_price='$option_select' WHERE post_id=$PostIdvalue");
                                        header('location:view_all_post.php');
                                    }
                                    
                                }
                            }
                            ?>
                            <form action="view_all_post.php" method="POST">
                                <div class="row">
                                    <div class="col-xl-4" id="bulkOptions">
                                        <input type="number" name="options">
                                    </div>
                                    <div class="col-xl-4">
                                        <input type="submit" value="Apply" class="btn btn-sm btn-primary shodom-sm">
                                    </div>
                                </div><br>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="SelectAllBoxes"></th>
                                            <th>Id</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>price</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Approve</th>
                                            <th>Unapprove</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
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

                                            echo  "<tr>
                <th><input type='checkbox' class='cheakbox' name='selectBox[]' value='$post_id'></th>                                            
                <td>$post_id</td>
                <td>$post_author</td>
                <td>$post_title</td>
                <td>$post_price</td>
                <td>$post_cat</td>
                <td>$post_status</td>
                <td> <img  style='width:70px;'src='../course/assets/$post_img'></td>
                <td>$post_date</td>
                <td><a href='view_all_post.php?g=$post_id'>Publish</a></td>
                <td><a href='view_all_post.php?z=$post_id'>Unpublish</a></td>
                <td><a href='edit_post.php?post_id=$post_id'>Edit</a></td>
                <td><a href='view_all_post.php?del=$post_id'>Delete</a></td>                
                 </tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </form>
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
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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