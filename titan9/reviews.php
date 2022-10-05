<!doctype html>
<html lang="en">

<head>
    <title>reviews</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-----reb_css-------->
    <link rel="stylesheet" href="reb.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php session_start();
  include '../include/init.php';
  if ($_SESSION['zdk'] !== 'Admin') {
    header('location:../');
  }
  ?>
    <div class="container">
        <h2 class="reviews_title">Reviews</h2>
        <hr>
        <ol>
            <?php
      $enc = $_GET['r'];
      $sel_reviews = POST::sel_table_by_id('reviews', 'review_post_id', $enc);
      while ($row = mysqli_fetch_assoc($sel_reviews)) {
        $author = $row['author'];
        $reviews = base64_decode($row['reviews']);
        $reviews_id = $row['review_id'];
        $date = $row['date'];
      ?>
            <li class="reviews_list"><a
                    href="#"><?php echo htmlspecialchars($author); ?>/-(<?php echo $date; ?>):</a><?php echo htmlspecialchars($reviews); ?><a
                    class="del_del" href="reviews.php?d=<?php echo $reviews_id; ?>">Delete</a></li> <br>
            <?php } ?>
        </ol>
    </div>
    <?php
  if (isset($_GET['d'])) {
    $del = $_GET['d'];
    $delete = POST::delete('reviews', 'review_id', $del);
    if ($delete) {
      header('location:status.php');
    }
  }

  ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>