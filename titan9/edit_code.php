<?php 
ob_start();
include 'include/header.php';

// include '../include/init.php'; ?>
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
    <div class="container-fluid">

<!-- Bar Chart -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Content Row -->
<?php
if(isset($_GET['code'])){
    $code=$_GET['code'];
    $select_code=POST::sel_table_by_id('embed','embed_id',$code);
    $fetch_data=mysqli_fetch_assoc($select_code);
    $code_title=$fetch_data['embed_title'];
    $embed_code=$fetch_data['embed_code'];
}
?>

<div class="row">

  <!-- Area Chart -->
  <div class="col-xl-6 col-lg-6"  style="height: 200px;">
  <br>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
      <form action="edit_code.php?code=<?php echo $code; ?>" method="post">
      <label for="cat-title">Insert code title:  </label>
          <input type="text" value="<?php echo $code_title; ?>" class="form-control" name="code_title"><br>
          <label for="">Insert Code:</label>
          <input type="text" value="<?php echo  htmlspecialchars($embed_code); ?>" class="form-control" name="embed_code"><br>
          <input type="submit" class="btn btn-primary" value="submit" name="update">         
      </form>
  
      </div>
      
    </div>

  </div>


  </div>
</div>
   </div>
</div>
</div>
<?php 

if(isset($_POST['update'])){
    $code_titlel=$_POST['code_title'];
    $embed_code=$_POST['embed_code'];
   $update=POST::update_code($code_titlel,$embed_code,$code);
   header("location:edit_code.php?code=$code");
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
