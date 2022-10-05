<?php ob_start();
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

                <!-- Begin Page Content -->
                <div class="container-fluid"><br><br>


                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Home details</h6>
                        </div>
                        <div class="card-body">
                            <?php
              $select = Post::select_all_table('home');
              $row = mysqli_fetch_assoc($select);
              $title = $row['header'];
              $footer = $row['footer'];

              ?>
                            <form action="home_edit.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" value="<?php echo $title; ?>" class="form-control" name="haeder">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="update" class="btn btn-primary" name="update_post">
                                </div>
                            </form>


                            <form action="home_edit.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Footer</label>
                                    <input type="text" value="<?php echo $footer; ?>" class="form-control"
                                        name="footer">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="update" class="btn btn-primary" name="update_footer">
                                </div>
                            </form>

                            <?php
              $select = Post::select_all_table('page');
              $row = mysqli_fetch_assoc($select);
              $page_id = $row['id'];
              $number = $row['page_no'];

              $select = Post::select_all_table('feed');
              $row = mysqli_fetch_assoc($select);
              $feed_id = $row['id'];
              $feed_vid = $row['feed'];
              ?>

                            <form action="home_edit.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Number of results ber page</label>
                                    <input type="number" value="<?php echo $number; ?>" class="form-control"
                                        name="page">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="update" class="btn btn-primary" name="update_page">
                                </div>
                            </form>

                            <form action="home_edit.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Update feed</label>
                                    <input type="text" class="form-control" name="feed_code"
                                        placeholder="Update feed...">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="update" class="btn btn-primary" name="update_feed">
                                </div>
                            </form>




                            <?php
              if (isset($_POST['update_page'])) {
                $results_per_page = $_POST['page'];
                $page_id = 1;
                $update = Post::insert_no_of_page('page_no', $results_per_page, $page_id);
                if ($update) {
                  header('location:home_edit.php');
                } else {
                  echo "Query faild";
                }
              }
              if (isset($_POST['update_post'])) {
                $header = $_POST['haeder'];
                $ref = 'LEARN BIG';
                $update = Post::insert_header('header', $header, $ref);
                header('location:home_edit.php');
              }
              if (isset($_POST['update_feed'])) {
                $delete_notify = POST::qurey("DELETE FROM feed_notify");
                $feed_code = $_POST['feed_code'];
                $update = Post::insert_feed('feed', $feed_code, $feed_id);
                if ($update == true) {
                  header('location:home_edit.php');
                } else {
                  echo "Qurey failed";
                }
              }
              ?>

                        </div>
                    </div>
                </div>
                <?php
        if (isset($_POST['update_footer'])) {
          $ref = "LEARN BIG";
          $footer = $_POST['footer'];
          $cook = Post::insert_header('footer', $footer, $ref);
          if ($cook) {
            header("location:home_edit.php");
          } else {
            echo 'Query faild';
          }
        }
        ?>


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