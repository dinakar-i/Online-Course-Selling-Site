<?php
ob_start();

include 'include/header.php';
// include '../include/init.php'; 
?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'include/saide_bar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'include/post_nav.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Show All Qustions</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Qustions</th>
                                        <th>Show Replays</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    if(isset($_GET['q'])){
                                        $del_id = $_GET['q'];
                                        POST::delete('qus_notify', 'qus_post_id', $del_id);
                                    }
                                    $get_id = $_GET['q'];
                                    $sel_qus = POST::sel_table_by_id('question', 'qus_post_id', $get_id);
                                    while ($row = mysqli_fetch_assoc($sel_qus)) {
                                        $qustions = base64_decode($row['question']);
                                        $qu_id = $row['qus_id'];
                                        echo "<tr>";
                                        ?>

                                      <td><?php echo htmlspecialchars($qustions) ?></td>
                                      <?php 
             echo "
             <td><a href='replay.php?q=$qu_id'>Replays</a></td>
             <td><a href='qustions.php?g=$qu_id'>Delete</a></td>
            </tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <?php
        
        if (isset($_GET['g'])) {
            $del_id = $_GET['g'];
            $delete = POST::delete('question', 'qus_id', $del_id);
            if ($delete) {
                header('location:status.php');
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