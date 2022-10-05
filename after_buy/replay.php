<!doctype html>
<html lang="en">

<head>
    <title>View repaly</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="reb.css">
    <link rel="stylesheet" href="vimeo.css">
    <!-----goole fonts---->
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lemonada&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body  style=" background:white  no-repeat fixed">
    <div class="container">
        <div class="header">
            <?php
            session_start();
            if ($_SESSION['zdk'] == '') {
                header('location:../profile.php');
            }
            include '../include/init.php';
            $name = $_SESSION['first_name'];
            $post_id = $_GET['g'];
            if ($post_id == '') {
                header('location:../buy/');
            }
            $well = base64_decode(urldecode($post_id));
            $sql_well = mysqli_real_escape_string($conn, $well);
            
            $wel = intval($sql_well);
            $enc = $wel / 7094;
            $sel_qustion = POST::qurey("SELECT * FROM question WHERE qus_id=$enc");
            $qus_count = mysqli_num_rows($sel_qustion);
            if ($qus_count == 0) {
                header('location:../course/');
            }
            $row = mysqli_fetch_assoc($sel_qustion);
            $qus = base64_decode($row['question']);
            ?>
            <h4  style="text-align: center;" class="qus"><?php echo htmlspecialchars($qus); ?></h4>
        </div>
        <br>
        <form action="replay.php?g=<?php echo $post_id; ?>" method="post"> <input type="text" class="replay_box" name="replay_box">
            <input type="submit" value="send replay" class="send_btn" name="send">
        </form><br>
        <?php
        if (isset($_POST['send'])) {
            if ($_POST['replay_box'] !== '') {
                $reb = base64_encode($_POST['replay_box']);
                $reb_qus_id = $enc;
                $insert_reb = POST::insert_replay($reb_qus_id, $reb, $name);
                User::Qustion_replay($enc,$_SESSION['username'],$_SESSION['first_name'],$_POST['replay_box']);
                $location='location:replay.php?g='.$post_id;
                header($location);
            }
        }
        ?>
        <h4 class="replay">Replays/-</h4>

        <?php
        $select_reb = POST::sel_table_by_id('replay', 're_post_id', $enc);
        $replay_count = mysqli_num_rows($select_reb);
        if ($replay_count == 0) {
            echo "<img style='width:500px' src='img/znsdfufujfdifzjfhuwefojewne878475u2eij3ij.png'>";
        } else {
            echo "<div class='list_qustions'>
            <ol>";
            while ($row = mysqli_fetch_assoc($select_reb)) {
                $author = $row['author'];
                $replays = base64_decode($row['replay']);
        ?>

                <li style="font-family: 'Fredoka One', cursive;">
                    <div>
                        <h1 class="qus_list"> <?php echo htmlspecialchars($author); ?>:
                            <a style="text-decoration: none; color:black;" href="#"><?php echo htmlspecialchars($replays, ENT_QUOTES, 'UTF-8'); ?></a>
                        </h1>
                    </div>
                </li>
                <?php }
                echo "</ol><br>     
    </div>";
            } ?> <br>
 
<button style='background-color: #309F8E;border-color:#309F8E;' onclick='read_more()'type='button' class='btn btn-primary btn_text'>Read more</button>
 <br><br>
    </div>
    <!---payment cheak--->
    <?php
    if (!isset($_SESSION['zdk'])) {
        header('location:../');
    }
    ?>
    <!-- Optional JavaScript -->
    <script>
                function read_more() {
                    let list_qustions = document.querySelector('.list_qustions');
                    let btn_text = document.querySelector('.btn_text');
                    let var2 = btn_text.innerHTML
                    
                    if (var2 === 'Read more') {
                        list_qustions.style.height = 'auto';
                        btn_text.innerHTML = 'Read less';
                    } else {
                        list_qustions.style.height= '250px';
                        btn_text.innerHTML = 'Read more';
                    }
                }
            </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>