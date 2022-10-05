<?php
ob_start();
include 'include/header.php';
// include '../include/init.php'; 
// if (!isset($_GET['post'])) {
//   header('location:status.php');
// }
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
        if (isset($_GET['post'])) {
          $post_id = $_GET['post'];
        }
        if(isset($_POST['selectEmbed'])){
          foreach ($_POST['selectEmbed'] as $EmbedBox_value){
            $select_option=$_POST['select_option'];
            switch($select_option){
              case 'approve';
              $update_status = POST::qurey("UPDATE embed SET status='Approve' WHERE embed_id=$EmbedBox_value");
            break;
            case 'unapprove';
            $update_status = POST::qurey("UPDATE embed SET status='Unapprove' WHERE embed_id=$EmbedBox_value");
          break;
            case 'delete';
            $del = Post::qurey("DELETE FROM embed WHERE embed_id=$EmbedBox_value");
        break;
          }
        }
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
                            <div class="col-xl-6 col-lg-6" style="height: 200px;">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Code title</h6>

                                    </div>
                                    <!-- Card Body -->
                                    <h6 style="margin-left: 30px;margin-top:20px;">Introduction</h6>
                                    <div class="card-body">
                                        <form action="insert_code.php?post=<?php echo $post_id; ?>" method="post">
                                            <!-- <label for="cat-title">Add Categories:  </label> -->
                                            <input type="text" class="form-control" name="cat_title"><br>
                                            <h6 class="m-0 font-weight-bold text-primary">Insert code</h6><br>
                                            <input type="text" class="form-control" name="code"><br>
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">


                                        </form>
                                        <?php

                    if (isset($_POST['submit'])) {
                      $embed_title = $_POST['cat_title'];
                      $post_id = $_GET['post'];
                      $embed_code = $_POST['code'];
                      $status = 'Unapprove';
                      if ($embed_title !== '' and $embed_code !== '') {
                        $update = Post::qurey("INSERT INTO embed (embed_title,embed_code,embed_post_id,status) VALUES ('$embed_title','$embed_code',$post_id,'$status')");
                        header('location:insert_code.php?post='.$post_id);
                      }
                    }

                    ?>
                                    </div>

                                </div>

                            </div>


                            <div class="col-xl-6 col-lg-6   ">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
                                        <div class="dropdown no-arrow">
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <form action='insert_code.php?post=<?php echo $post_id; ?>' method="post">
                                    <select name="select_option" class="form-control">
                                    <option value="unapprove">Unapprove</option>
                                      <option value="approve">Approve</option>
                                      <option value="delete">Delete</option>
                                      
                                    </select>
                                    <br>
                                      <input style="width: 100px;margin-left:30px;" type="submit" value="Submit">
                                      <br>
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="SelectAllEmbed"></th>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Approve</th>
                                                    <th>UnApprove</th>
                                                    <th>Delete</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                        if (isset($_GET['post'])) {
                          $post_id = $_GET['post'];
                          $cat_qurey = Post::qurey("SELECT * FROM embed WHERE embed_post_id=$post_id");
                          while ($row = mysqli_fetch_assoc($cat_qurey)) {
                            $embed_post_id = $row['embed_post_id'];
                            $embed_code = $row['embed_code'];
                            $embed_title = $row['embed_title'];
                            $embed_status = $row['status'];
                            $embed_id = $row['embed_id'];
                            echo "<tr>
                <td><input type='checkbox' class='cheakbox' name='selectEmbed[]' value='$embed_id'></td>
                <td>$embed_title</td>
                <td>$embed_status</td>
                <td><a href='insert_code.php?a=$embed_id'>Approve</a></td>
                <td><a href='insert_code.php?u=$embed_id'>UnApprove</a></td>
                <td><a href='insert_code.php?delete=$embed_id'>Delete</a></td>
                <td><a href='insert_code.php?edit=$embed_id'>Edit</a></td>";
                          }
                        }
                        if (isset($_GET['a'])) {
                          $id = $_GET['a'];
                          $update_status = POST::qurey("UPDATE embed SET status='Approve' WHERE embed_id=$id");
                          if ($update_status == true) {
                            header("location:status.php");
                          } else {
                            echo 'Query failed';
                          }
                        }

                        if (isset($_GET['u'])) {
                          $id = $_GET['u'];
                          $update_status = POST::qurey("UPDATE embed SET status='Unapprove' WHERE embed_id=$id");
                          if ($update_status == true) {
                            header("location:status.php");
                          } else {
                            echo 'Query failed';
                          }
                        }
                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    if (isset($_GET['delete'])) {
      $del_id = $_GET['delete'];
      $del = Post::qurey("DELETE FROM embed WHERE embed_id=$del_id");
      if ($del == true) {
        header('location:status.php');
      }
      // header('location:view_all_post.php');
    }
    if(isset($_GET['edit'])){
      $edit_code=$_GET['edit'];
      header('location:edit_code.php?code='.$edit_code);
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
    <script>


      $('#SelectAllEmbed').click(function () {
       if(this.checked){
            $('.cheakbox').each(function(){
            this.checked=true;
                    })
      }else{
        $('.cheakbox').each(function(){
            this.checked=false;
                    })

      }
});

    </script>
</body>

</html>