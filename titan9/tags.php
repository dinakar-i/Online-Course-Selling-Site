<?php 
ob_start();
include 'include/header.php';
// include '../include/init.php'; 
if(!isset($_GET['post'])){
   header('location:status.php');
}
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
<?php include 'include/nav_bar.php';
if(isset($_GET['post'])){
  $post_id=$_GET['post'];
}
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
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Tags</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
      <form action="tags.php?post=<?php echo $post_id;?>" method="post">
      <!-- <label for="cat-title">Add Categories:  </label> -->
          <input type="text" class="form-control" name="cat_title"><br>
          <input type="submit" class="btn btn-primary" name="submit" value="Submit">
          
            
      </form>
      <?php 
      
      if(isset($_POST['submit'])){
           $tag_title=$_POST['cat_title'];
           $post_id=$_GET['post'];
          if($tag_title!==''){
            $update=Post::qurey("INSERT INTO tags (taga_title,tags_post_id) VALUES ('$tag_title',$post_id)");
            // header('location:status.php');
          }
          }
            
            ?>
      </div>
      
    </div>

  </div>

  
  <div class="col-xl-6 col-lg-6   ">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
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
                  </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($_GET['post'])){
                  $post_id=$_GET['post'];
                $cat_qurey=Post::qurey("SELECT * FROM tags WHERE tags_post_id=$post_id");                          
                while($row=mysqli_fetch_assoc($cat_qurey)){ 
                 $tag_id=$row['tags_id'];
                  $tag_post_id=$row['tags_post_id'];
                  $tags_title=$row['taga_title'];   
                echo "<tr>
                <td>$tag_post_id</td>
                <td>$tags_title</td>
                <td><a href='tags.php?delete=$tag_id'>Delete</a></td> ";
                }
            }
                ?>
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
  <?php 
  if(isset($_GET['delete'])){
    $del_id=$_GET['delete'];
    $del=Post::qurey("DELETE FROM tags WHERE tags_id=$del_id");
    header('location:status.php');
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
