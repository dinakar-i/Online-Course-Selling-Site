<?php
ob_start();
session_start();
include '../include/init.php';
include '../include/chat.php';
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="../img/logo.png">
    <title>Course | <?php
                    $post_id = $_GET['q'];
                    if ($post_id == '') {
                        header("location:../course/");
                    }
                    $well = base64_decode(urldecode($post_id));
                    $sql_well = mysqli_real_escape_string($conn, $well);
                    $wel = intval($sql_well);
                    $enc = $wel / 7094952419;
                    $post = POST::sel_table_by_id('posts', 'post_id', $enc);
                    $count_poster = mysqli_num_rows($post);
                    if ($count_poster == 0) {
                        echo "404";
                    } else {
                        $row = mysqli_fetch_assoc($post);
                        $post_title = $row['post_title'];
                        echo $post_title;
                    } ?></title>
    <!-- Required meta tags -->
    <!---font awsome cdn---->
    <script src="https://kit.fontawesome.com/14dbca7644.js" crossorigin="anonymous"></script>
    <!---goole fonts-->
    <?php
    include '../include/font.php';
    ?>
    <!---goole fonts end here-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $post_title ?>">
    <link rel="stylesheet" href="css/google.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="nav_bar">
        <div class="path_div"><a style="text-decoration: none;font-family: 'Merienda One', cursive;" href="/">Profile</a> / <a style="text-decoration: none;font-family: 'Merienda One', cursive;" href="../course/">Course</a></div>
    </div><br><br><br>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['post_id'])) {
                $post_id = $_GET['q'];
            }
            $well = base64_decode(urldecode($post_id));
            $sql_well = mysqli_real_escape_string($conn, $well);
            $wel = intval($sql_well);
            $enc = $wel / 7094952419;
            $post = POST::sel_table_by_id('posts', 'post_id', $enc);
            $total_count = mysqli_num_rows($post);
            if ($total_count == 0) {
                echo "<img class='error_img' src='../img/error.png'>";
            } else {
                $row = mysqli_fetch_assoc($post);
                $post_title = $row['post_title'];
                $price = $row['post_price'];
            ?>
                <div class="col-sm-8 right">
                    <h1 class="buy_tx"><?php echo $post_title; ?></h1>
                    <a href="#">
                        <div class="box">
                            <?php $post = POST::sel_table_by_id('posts', 'post_id', $enc);
                            $row = mysqli_fetch_assoc($post);
                            $img = $row['post_img'];
                            ?>
                            <i data-toggle="modal" data-target="#exampleModalCenter" style="font-weight: bold;" class="far fa-play-circle ico"></i>
                            <img data-toggle="modal" data-target="#exampleModalCenter" class="img" style="width: 100%;height: 100%;" src="/course/assets/<?php echo $img; ?>">
                        </div>
                    </a>
                    <a style='text-decoration:none;' href="../after_buy/?q=<?php echo $post_id . '#'; ?>">
                        <h1 class="buy_tx">Congrats welcome this course</h1>
                    </a>
                    <?php
                    include '../include/about_course.php';
                    ?>
                    <div class="review">
                        <form action="99.php?q=<?php echo $post_id; ?>" method="POST">
                            <h5 class="h4">Set your review :)</h5>
                            <div class="re_div">
                                <i class="fas fa-star re_ico"></i></i>
                                <i class="fas fa-star re_ico"></i></i>
                                <i class="fas fa-star re_ico"></i></i>
                                <i class="fas fa-star re_ico"></i></i>
                                <i class="fas fa-star re_ico"></i></i>
                            </div>
                            <input type="text" class="review_box" data-validate="keys is required" name="review_box">
                            <input type="submit" class="btnr" value="Submit" name="submit">
                        </form>
                        <?php

                        if (isset($_POST['submit'])) {
                            if ($_POST['review_box'] !=='') {
                                $reviews = base64_encode($_POST['review_box']);
                                $author = htmlspecialchars($_SESSION['first_name']);
                                $date = date('d-m-y');
                                $select_qurey_re = POST::qurey("SELECT * FROM reviews WHERE review_post_id=$enc AND author='$author'");
                                $re_count = mysqli_num_rows($select_qurey_re);
                                if ($re_count <= 2) {
                                    $insert = POST::insert_reviews($reviews, $enc, $date, $author);
                                   header("location:99.php?q=".$post_id);
                                } else {
                                    echo "<div class='review_div'><a href='#' style='color:#D1ECF1'><spam class='re_limit'>You can set only 3 reviews<spam></a></div>";
                                }
                            }else{
                                header("location:99.php?q=$post_id");
                            }
                        }
                        ?>
                    </div>
                </div>
                <!--------------------------pop------------------------------------->

                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div style="background-color: black;" class="modal-content video_div">
                            <div class="video_bottom_div">
                                <?php echo "<h4 class='video_top_title_div'>$post_title<h4>" ?>
                            </div>
                            <?php

                            // echo $enc;
                            $select_vid = POST::select_intro($enc);
                            $code_count = mysqli_num_rows($select_vid);
                            if ($code_count == 0) {
                                echo "<img class='eroor' src='../img/error.png' alt='loaded'>";
                            } else {
                                $fetch = mysqli_fetch_assoc($select_vid);
                                $code = $fetch['embed_code'];
                                echo $code;
                            }
                            ?>
                            <div class="video_top_div">
                                <a href="#">
                                    <div class="first_circle">
                                        <i class="fas fa-thumbs-up glow"></i>
                                    </div>
                                </a>

                                <a href="#">
                                    <div class="first_circle">
                                        <i class="fab fa-instagram glow"></i>
                                    </div>
                                </a>
                                <a href="#" data-dismiss="modal">
                                    <div class=" first_circle">
                                        <i style="margin-left: 11px;" class="far fa-times-circle glow"></i>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="first_circle">
                                        <i class="fab fa-twitter glow"></i>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="first_circle">
                                        <i class="fab fa-facebook-square glow"></i>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-------------------pop ends here----------------------->
                <div class="col-sm-4 left">
                    <!---Tags-------->
                    <div class="tag_div">
                        <h4 class="tag">Tags</h4>
                        <hr class="line">
                        <ul>
                            <?php
                            $tag = POST::sel_table_by_id('tags', 'tags_post_id', $enc);
                            while ($low = mysqli_fetch_assoc($tag)) {
                                $tag_title = $low['taga_title'];
                                echo "<a href='#' style=' text-decoration: none;'><li class='li'>$tag_title</li></a>";
                            }
                            ?>
                        </ul><br><br><br>
                    </div>
                    <!---tags ends here-->
                    <!------categories-->
                    <h4 class="tag">Categories</h4>
                    <hr style="width: 130px;" class="line">
                    <ul>
                        <?php
                        $cat = POST::sel_table_by_id('posts', 'post_id', $enc);
                        $fetch_cat = mysqli_fetch_assoc($cat);
                        $cat_title = $fetch_cat['post_cat'];
                        echo "<a href='#' style=' text-decoration: none;'><li class=li> $cat_title</li></a>";
                        ?>
                    </ul><br>
                    <!-----categories ends here------>
                    <!----Recurments-->
                    <h4 class="tag">Requirements</h4>
                    <hr style="width: 150px;" class="line">
                    <ul>
                        <?php
                        $req = POST::sel_table_by_id('recurments', 'rec_post_id', $enc);
                        while ($row = mysqli_fetch_assoc($req)) {
                            $req_title = $row['recurments'];
                            echo "<li class='req_tx'> $req_title</li>";
                        }
                        ?>
                    </ul>
                    <!------Description-->
                    <h4 class="tag"> Course Description</h4>
                    <hr style="width: 230px;" class="line">
                    <?php
                    $pas = POST::sel_table_by_id('passage', 'pas_post_id', $enc);
                    while ($row = mysqli_fetch_assoc($pas)) {
                        $pas_title = $row['passage'];
                        echo "<p class='dis'>$pas_title</p>";
                    }

                    ?>

                    <!--Description ends here-->
                    <h4 class="tag">Course Reviews/-</h4>
                    <hr style='width: 230px;' class="line">
                    <div class="rei_box">
                        <ul>
                        <?php
                            $review_array=[];
                            $author_array=[];
                            $date_array=[];
                            $pas = POST::sel_table_by_id('reviews', 'review_post_id', $enc);
                            while ($row = mysqli_fetch_assoc($pas)) {
                                $review = base64_decode($row['reviews']);
                                array_push($review_array,$review);
                                $author = htmlspecialchars($row['author']);
                                array_push($author_array,$author);
                                $date = $row['date'];
                                array_push($date_array,$date);
                            }
                            
                            $i=sizeof($review_array)-1;
                            foreach ($review_array as $reverse_array){
                          ?>
                     <a href='#' style='text-decoration:none;color:black;'><li class='li_reviwe' style='color:black;'>👨‍🎓 <?php echo htmlspecialchars($author_array[$i]).'('.htmlspecialchars($date_array[$i]).'): ' ?> <a style='text-decoration:none; color:white;' href='#'><?php echo htmlspecialchars($review_array[$i])?></a></li></a><br>
                          <?php
                          $i=$i-1;
                            }
                            ?>

                        </ul>

                    </div>
                </div>
        </div>
          <!--show contend in this course---->
          <div class="container">
            <h4 class='learn_head'>Show what we learn in this course:</h4>
            <br>
            <div class="contend_course">
                <div class="div_li_con"></div>
                <ul>
                    <?php
                    $con_title = POST::sel_table_by_title('contend', 'p_id', $enc);
                    while ($row = mysqli_fetch_assoc($con_title)) {
                        $cat_title = $row['con_title'];
                    ?>
                        <li class="contend_li">📜 <?php echo htmlspecialchars($cat_title) ?></li>
              
                    <?php } ?>

                </ul>

            </div><br>
        <div class="container">
            <h4 class='learn_head'>Title in this course:</h4>
            <div id="accordion">
                <div class="card">
                    <div class="learn_box" class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button style="text-decoration: none;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-play learn_ico"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <?php
                                $select_learn = POST::sel_table_by_id('embed', 'embed_post_id', $enc);
                                while ($fetch_title = mysqli_fetch_assoc($select_learn)) {
                                    $learn_title = $fetch_title['embed_title'];

                                ?>
                                    <a style="text-decoration: none; color:black;" href="#">
                                        <li class="learn_li"><i class="fas fa-check"></i><?php echo ' ' . $learn_title; ?>
                                        </li>
                                    </a>
                                <?php } ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <?php
                $video = POST::sel_table_by_id_approve('embed', 'embed_post_id', $enc);
                $sample_count = mysqli_num_rows($video);
                if ($sample_count !== 0) {
                    echo "<h4 class='learn_head'>Sample videos</h4>";
                }
                while ($fetch_video = mysqli_fetch_assoc($video)) {
                    $embed_title = $fetch_video['embed_title'];
                    $embed_code = $fetch_video['embed_code'];
            ?>
                <div class="card sample_div" style="width: 18rem; margin-left:10px;">
                    <?php echo $embed_code; ?>
                    <div class="card-body">
                        <p class="card-text"><?php echo $embed_title; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>
        <!---payments cheak----->
        <?php
                if ($_SESSION['zdk'] !== 'Gold') {
                    if ($price == 0) {
                        if ($_SESSION['zdk'] == '') {
                            header('location:../Login/');
                        }
                    } else {
                        if ($_SESSION['zdk'] == '') {
                            header('location:../Login/');
                        } else {
                            $email = $_SESSION['username'];
                            $select_payment = POST::check_payment($post_title, $email);
                            $payments_true = mysqli_num_rows($select_payment);
                            if ($payments_true == 0) {
                                $ide = $post_id;
                                header("location:../payment/pay.php?q=$post_id");
                            }
                        }
                    }
                }

        ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="js/script.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
           <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>
<?php }
