<?php
ob_start();
include 'include/header.php';
// include 'include/init.php';
?>

<body id="page-top">
    <?php

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
                <?php include 'include/nav_bar.php'; ?>
                <!-- Begin Page Content -->

                <!-- Bar Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Update a Post</h6>
                    </div>

                    <?php
                    if (isset($_GET['post_id'])) {
                        $id = $_GET['post_id'];
                        $qurey = Post::sel_post_id($id);
                        $row = mysqli_fetch_assoc($qurey);
                        $db_post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_price = $row['post_price'];
                        $stuts = $row['status'];
                        $post_content = $row['post_content'];
                        $post_cat = $row['post_cat'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_img'];
                    }
                    if (isset($_POST['update'])) {
                        $post_title = $_POST['post_title'];
                        $post_category = $_POST['categories'];
                        $post_price = $_POST['price'];
                        $change_id = $_GET['ide'];
                        $post_author =  $_POST['post_author'];
                        $post_status = $_POST['status'];

                        $post_image = $_FILES['image']['name'];
                        $post_image_temp = $_FILES['image']['tmp_name'];

                        $p_id = $_POST['id'];
                        $post_content = $_POST['post_content'];
                        $post_date = date('d-m-y');
                        $rename = md5(rand()) . '.' . 'jpg';
                        if ($post_image !== '') {
                            move_uploaded_file($post_image_temp, "../course/assets/$rename");
                            $post_qurey = Post::qurey("UPDATE posts SET post_id=$p_id, post_title='$post_title',post_content='$post_content',post_date='$post_date',post_author='$post_author',post_img='$rename',post_cat='$post_category',post_price='$post_price',status='$post_status'WHERE post_id=$change_id");
                        } else {
                            echo "<script>alert('select image')</script>";
                        }
                        if (!$post_qurey) {
                            echo 'qurey failed';
                        } else {
                            header('location:view_all_post.php');
                        }
                    }
                    ?>



                    <form action="edit_post.php?ide=<?php echo $db_post_id ?>" method="post" enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Post order</label><br>
                                <input value='<?php echo $db_post_id; ?>' type="number" name="id">
                            </div>

                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title">
                            </div>

                            <div class="form-group">
                                <label for="title">Post Price</label><br>
                                <input value="<?php echo $post_price; ?>" type="number" name="price">
                                <label for="title">Category</label><br>
                                <select name="categories" id="">
                                    <?php
                                    $sel = Post::select_all_table('categories');
                                    while ($row = mysqli_fetch_assoc($sel)) {
                                        $cat_title = $row['cat_title'];
                                    ?>
                                        <option value="<?php echo $cat_title; ?>"> <?php echo $cat_title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Post Author</label>
                                <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author">
                            </div>

                            <div class="form-group">
                                <label for="title">Post Status</label>
                                <select name="status">
                                    <option value="publish">Publish</option>
                                    <option value="unpublish">Unpublish</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="post_image">Post Image</label><br>
                                <img width='200px' src="../course/assets/<?php echo $post_image; ?>" alt="" srcset=""><br><br>
                                <input type="file" name="image">
                            </div>


                            <div class="form-group">
                                <label for="title">Post Content</label>
                                <input type="text" value="<?php echo $post_content; ?>" class="form-control" name="post_content">
                            </div>


                            <div class="form-group">
                                <input type="submit" value="Update Post" class="btn btn-primary" name="update">
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