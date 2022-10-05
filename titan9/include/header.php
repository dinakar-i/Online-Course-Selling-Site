<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin <?php echo  $_SESSION['first_name'] ?> - Dashboard</title>
  <!--------------------font awsome------------------>
  <script src="https://kit.fontawesome.com/14dbca7644.js" crossorigin="anonymous"></script>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="js/script.js"></script>
  <!---google charts---------->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);
    <?php
    include 'init.php';
    $categories = POST::select_all_table('categories');
    $categories_count = mysqli_num_rows($categories);
    $tag = POST::select_all_table('tags');
    $tag_count = mysqli_num_rows($tag);
    $post = POST::select_all_table('posts');
    $post_count = mysqli_num_rows($post);

    ?>

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Categories', 'Tags', 'Posts'],
        ['details', <?php echo $categories_count; ?>, <?php echo $tag_count; ?>, <?php echo $post_count; ?>]
        // ['2014', 1000, 400, 200],
        // ['2015', 1170, 460, 250],
        // ['2016', 660, 1120, 300],
        // ['2017', 1030, 540, 350]
      ]);

      var options = {
        chart: {
          title: 'Company Performance',
          subtitle: 'Sales, Expenses, and Profit: 2014-2017',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
  <!--google charts ends here--->
  <link rel='stylesheet' href='reb.css'>
</head>