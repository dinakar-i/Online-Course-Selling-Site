<!doctype html>
<html lang="en">

<head>
    <title>what's | New</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="assets/fav.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>

<body>
    <?php
    session_start();
    include '../include/init.php';
    $email = $_SESSION['username'];
    $sql_email = mysqli_real_escape_string($conn, $email);
    $select_notiy_user = POST::sel_table_by_title('feed_notify', 'email', $sql_email);
    $user_county = mysqli_num_rows($select_notiy_user);
    if ($user_county == 0) {
        $insert_value = POST::qurey("INSERT INTO feed_notify (email) VALUE ('$email')");
    }

    ?>
    <div class="container">
        <h1>Watch Tv</h1>
        <div class="monitor">
            <?php
        if(!isset($_SESSION['zdk'])){
            header('location:../');
        }
            $select_feed = POST::select_all_table('feed');
            $row = mysqli_fetch_assoc($select_feed);
            $feed_vid = $row['feed'];
            echo $feed_vid;
            ?>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>