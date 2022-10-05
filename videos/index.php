<!doctype html>
<html lang="en">

<head>
  <?php
  include '../include/init.php';
  ?>
  <link rel="icon" href="../img/logo.png">
  <title>
    <?php
ob_start();
    $post_id = $_GET['q'];
    if ($post_id == '') {
      header('location:../course/');
    }
    $well = base64_decode(urldecode($post_id));
    $sql_well = mysqli_real_escape_string($conn, $well);
    $wel = intval($sql_well);
    $enc = $wel / 7094952419;
    $title_pst = POST::sel_table_by_id('posts', 'post_id', $enc);
    $title_count = mysqli_num_rows($title_pst);
    if ($title_count == 1) {
      $fetch_pst = mysqli_fetch_assoc($title_pst);
      $head_title = $fetch_pst['post_title'];
      $price = $fetch_pst['post_price'];
      echo "Videos | $head_title";
    } else {
      echo "404- NOT Fount";
      $price = '0';
    }

    ?>

  </title>
  <?php
  session_start();
  ?>
  <!---css---->
  <link rel="stylesheet" href="style.css">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!---google fonts--------->
  <link href="https://fonts.googleapis.com/css2?family=Jolly+Lodger&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@700&display=swap" rel="stylesheet">
  <!--google fonts ends here--------->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="back">
  <div class="nav">
    <?php
    if (isset($_SESSION['zdk'])=='') {
      header('location:../Login/');
    }
    ?>

  </div>
  <div class="container">
    <br><br><br>
    <ol>
      <?php
      $post = POST::sel_table_by_id('embed', 'embed_post_id', $enc);
      $total_count = mysqli_num_rows($post);
      if ($total_count == 0) {
        echo "<style>
        .back{
          background-color:white;
        }.
        </style>
        <img class='error_img' src='../img/error.png'>";
      } else {
        while ($row = mysqli_fetch_assoc($post)) {
          $embed_title = $row['embed_title'];
          $embed_code = $row['embed_code'];

      ?>
          <div class="card divs_c">
            <?php echo $embed_code; ?>
            <div class="card-body">
              <li style="font-family: 'Markazi Text', cursive;">
                <p style="font-family: 'Markazi Text', cursive;" class="card-text"><?php echo $embed_title; ?>
                </p>
              </li>
            </div>
          </div>
        <?php } ?>
    </ol>
  </div>
  <!-----payments cherak------>
  <?php
        $select_pay_post = POST::sel_table_by_id('posts', 'post_id', $enc);
        $fetch_row = mysqli_fetch_assoc($select_pay_post);
        $price = $fetch_row['post_price'];

        if ($_SESSION['zdk'] !== 'Gold') {
          if ($price == 0) {

            if ($_SESSION['zdk']=='') {
              header('location:../Login/');
            }

          } else {

            if (isset($_SESSION['zdk'])=='') {
              header('location:../Login/');
            }

            $email = $_SESSION['username'];
            $post = POST::sel_table_by_id('posts', 'post_id', $enc);
            $rows = mysqli_fetch_assoc($post);
            $post_title = $rows['post_title'];
            $select_payment = POST::check_payment($post_title, $email);
            $payments_true = mysqli_num_rows($select_payment);
            if ($payments_true == 0) {
              header('location:../course/');
            }
          }
        }
  ?>
  <!-- </div> -->
  <!---font awsome---->
  <script src="https://kit.fontawesome.com/14dbca7644.js" crossorigin="anonymous"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>
<?php }
