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
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>

                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <form action="insert_conduct.php" method="post">
                                            <!-- <label for="cat-title">Add Categories:  </label> -->
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Title..."><br>
                                            <input type="text" class="form-control" name="path"
                                                placeholder="Path.."><br>
                                            <input type="submit" class="btn btn-primary" value="submit" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6   ">
                                <br>
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Conducte details</h6>
                                        <div class="dropdown no-arrow">
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Path</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                        $select_con = POST::select_all_table('contuct');
                        while ($win = mysqli_fetch_assoc($select_con)) {
                          $id = $win['id'];
                          $title = $win['title'];
                          $path = $win['path'];

                        ?>
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $title; ?></td>
                                                    <td style="font-size:7px;"><?php echo $path; ?></td>
                                                    <td> <a href="insert_conduct.php?v=<?php echo $id; ?>">Remove</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>

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
        <!----insert conduct------------->
        <?php
    if (isset($_POST['submit'])) {
      $path = $_POST['path'];
      $title = $_POST['title'];
      if ($path !== '' && $title !== '') {
        $insert_con = POST::insert_con($title, $path);
        if ($insert_con) {
          header("location:insert_conduct.php");
        } else {
          echo 'Query failed';
        }
      }
    }
    ?>
        <!------insert conduct ends here------------>

        <!-------delete conduct------------------------>
        <?php
    if (isset($_GET['v'])) {
      $dell_id = $_GET['v'];
      $dell_con = POST::delete('contuct', 'id', $dell_id);
      if ($dell_con) {
        header('location:insert_conduct.php');
      } else {
        echo "Query faild";
      }
    }

    ?>
        <!------delete conduct ends here------------>
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