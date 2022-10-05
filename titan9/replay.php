<!doctype html>
<html lang="en">

<head>
    <title>ad-replays</title>
    <!------google fonts----->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- Required meta tags -->
    <link rel="stylesheet" href="reb.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <div class="container">
        <?php session_start();
    include '../include/init.php';
    $get_id = $_GET['q'];
    if ($get_id == '') {
      header("location:status.php");
    }
    $sel_reb = POST::sel_table_by_id('question', 'qus_id', $get_id);
    $row = mysqli_fetch_assoc($sel_reb);
    $Qustion = base64_decode($row['question']);
    ?>
        <h4 class="h4"><?php echo $Qustion; ?></h4>
        <hr class="line">
        <ol>
            <?php
      $sel_reb = POST::sel_table_by_id('replay', 're_post_id', $get_id);
      $rp_count = mysqli_num_rows($sel_reb);
      if ($rp_count == 0) {
        echo "<h4 class='need' style='font-family: 'Bebas Neue', cursive;'>No need replays this comment,</h4>";
      }
      while ($row = mysqli_fetch_assoc($sel_reb)) {
        $author = $row['author'];
        $replay = base64_decode($row['replay']);
        $rep_id = $row['re_id'];
      ?>
            <li>
                <div style="margin-top: 20px;" class="alert alert-dark" role="alert">
                    <a href=""><?php echo htmlspecialchars($author) ?>/-</a> <?php echo htmlspecialchars($replay) ?><a class="del"
                        href="replay.php?s=<?php echo $rep_id; ?>">Delete</a>
                </div>
            </li>
            <?php } ?>
        </ol>
        <?php
    if (isset($_GET['s'])) {
      $del_id = $_GET['s'];
      $delete = POST::delete('replay', 're_id', $del_id);
      header('location:status.php');
    }
    if ($_SESSION['zdk'] !== 'Admin') {
      header('location:../');
    }
    ?>
    </div>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

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