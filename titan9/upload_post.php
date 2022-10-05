<?php
ob_start();
include 'include/header.php';
// include '../include/init.php';
?>

<body id="page-top">
    <?php

    if (isset($_POST['submit'])) {
        $post_title = $_POST['post_title'];
        $post_category = $_POST['cat'];
        if ($post_category !== 'Free Courses') {
            $post_price = $_POST['price'];
        } else {
            $post_price = 0;
        }

        $post_author =  $_POST['post_author'];
        $post_status = $_POST['status'];
        $duration = $_POST['duration'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_id = $_POST['id'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $rename = md5(rand()) . '.' . 'jpg';
        if ($post_image !== '') {
            move_uploaded_file($post_image_temp, "../course/assets/$rename");
            $post_qurey = Post::qurey("INSERT INTO posts(post_id,post_title,post_content,post_date,post_author,post_img,post_cat,post_price,status,duration) VALUES ($post_id,'$post_title','$post_content','$post_date','$post_author','$rename','$post_category',$post_price,'$post_status',$duration)");
            header('location:view_all_post.php');
        } else {
            echo "<script>alert('select image file')</script>";
        }
    }
    ?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'include/saide_bar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->

                <!-- Bar Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Upload new Post</h6>
                    </div>
                    <div class="card-body">

                        <div class="form-group">

                            <form action="" method="post" enctype="multipart/form-data">
                                <label for="title">Post order</label><br>
                                <input type="number" name="id">
                        </div>
                        <div class="form-group">
                            <label for="title">Post Title</label>
                            <input type="text" value="" class="form-control" name="post_title">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Price</label><br>
                            <input type="number" name="price">
                            <label for="title">Category</label><br>
                            <select name="cat" id="">
                                <?php
                                $sel = Post::select_all_table('categories');
                                while ($row = mysqli_fetch_assoc($sel)) {
                                    $cat_title = $row['cat_title'];
                                ?>
                                    <option> <?php echo $cat_title; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Author</label>
                            <input type="text" value="" class="form-control" name="post_author">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Status</label>
                            <select name="status">
                                <option value="unpublish">Unpublish</option>
                                <option value="publish">Publish</option>
                            </select>
                        </div>
                        <label>Duration</label>
                        <input type="number" placeholder="duration" name="duration">

                        <div class="form-group">
                            <label for="post_image">Post Image</label><br>
                            <img width='200px' src="../course/assets/" alt="" srcset=""><br><br>
                            <input type="file" name="image">
                        </div>


                        <div class="form-group">
                            <label for="title">Post Content</label>
                            <input type="text" value="" class="form-control" name="post_content">
                        </div>


                        <div class="form-group">
                            <input type="submit" value="Upload Post" class="btn btn-primary" name="submit">
                        </div>


                        </form>

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