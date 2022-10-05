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
  <div class="col-xl-6 col-lg-6"  style="height: 200px;">
  <br>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
      <form action="categories.php" method="post">
      <!-- <label for="cat-title">Add Categories:  </label> -->
          <input type="text" class="form-control" name="cat_title"><br>
          <input type="submit" class="btn btn-primary" value="submit" name="submit">         
      </form>
      <?php if(isset($_POST['submit'])){
           $cat_title=$_POST['cat_title'];
          if($cat_title!==''){
            $update=Post::insert_categories($cat_title);
            header('location:categories.php');
          }else{
            header('location:categories.php');
          }
          }
            
            ?>
      </div>
      
    </div>

  </div>

  
  <div class="col-xl-6 col-lg-6   ">
    <br>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
        <div class="dropdown no-arrow">
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Categories</th>
                      <th>Remove</th>
                      <th>Edit</th>
                  </tr>
              </thead>
              <tbody>
              <?php 
                $cat_qurey=Post::select_all_table('categories');                            
                while($row=mysqli_fetch_assoc($cat_qurey)){ 
                  $cat_id=$row['cat_id'];
                  $cat_title=$row['cat_title'];   
                echo "<tr>
                <td>$cat_id</td>
                <td>$cat_title</td>
                <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
                <td><a href='categories.php?edit=$cat_id'>Edit</a></td></tr> ";
                }
                ?>
              </tbody>
          </table>
      </div>
    </div>
    
  </div>
  <?php 
if(isset($_GET['edit'])){
  $edit_id=$_GET['edit'];
$select_cat="SELECT * FROM categories where cat_id=$edit_id";
$select_cat_result=Post::qurey($select_cat);
  while($row=mysqli_fetch_assoc($select_cat_result)){
    $cat_id=$row['cat_id'];
    $cat_title=$row['cat_title'];
?>
<div class="col-xl-6 col-lg-6"  style="height: 200px;">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Categories</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
      <form name="cat_id"action="categories.php?id=<?php echo $cat_id;?>" method="post">
      <!-- <label for="cat-title">Add Categories:  </label> -->
          <input type="text" value='<?php echo $cat_title;?>' class="form-control" name="cat_name"><br>
          <input type="submit" class="btn btn-primary" value="Update" name="update">
      </form>
      </div>
      
    </div>

  </div>
  <?php }};?>
  <?php   if(isset($_POST['update'])){
 $cat_name=$_POST['cat_name'];
 $cat_no=$_GET['id'];
$result=Post::edit_cat($cat_name,$cat_id);
header('location:categories.php');
  }
 
?>
  </div>
</div>
   </div>
</div>
</div>
  <?php 
  if(isset($_GET['delete'])){
    $del_id=$_GET['delete'];
    $del=Post::delete('categories','cat_id',$del_id);
    header('location:categories.php');
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
