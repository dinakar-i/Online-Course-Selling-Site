<?Php
session_start();
include '../include/init.php';
include '../include/chat.php';
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="../img/logo.png">
    <title>profile-course</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->
    <!--google fonts--->
    <link href="https://fonts.googleapis.com/css2?family=Merienda+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="lol.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!-------nav bar------->
    <div class='nav'>
        <div class="path_div"><a style="text-decoration: none; color:blue;font-family: 'Merienda One', cursive;" href="/">Profile</a> / <a style="text-decoration: none; color:blue;font-family: 'Merienda One', cursive;" href="../course/">Course</a></div>
    </div>
    <!--------nav bar ends here------>
    <!-- slider_area_start -->
    <div class="popular_places_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb_70 tit">

                        <style>
                            .h3:hover {
                                color: rgb(212, 0, 255);
                            }

                            .tit {
                                margin-top: -50px;
                            }
                        </style>
                        <!-- <p>Suffered alteration in some form, by injected humour or good day randomised booth anim 8-bit hella wolf moon beard words.</p> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if (!isset($_SESSION['zdk'])) {
                    header('location:../');
                }
                $email = $_SESSION['username'];
                $sel_page_qurey = POST::select_all_table('page');
                $fetch_page = mysqli_fetch_assoc($sel_page_qurey);
                $results_per_page = $fetch_page['page_no'];
                $select_all_post = POST::sel_buy_course($email);
                $select_all_post_count = mysqli_num_rows($select_all_post);
                $number_of_pages = ceil($select_all_post_count / $results_per_page);
                if (!isset($_GET['page'])) {
                    $page = 1;
                    $sql_int = mysqli_real_escape_string($conn, $page);
                    $page_int = intval($sql_int);
                } else {
                    $page = $_GET['page'];
                    $sql_int = mysqli_real_escape_string($conn, $page);
                    $page_int = intval($sql_int);
                }
                $starting_limit = ($page_int - 1) * $results_per_page;
                if ($_SESSION['zdk'] == 'Admin' || $_SESSION['zdk'] == 'Subscriber') {
                    $select_post = POST::qurey("SELECT * FROM payments WHERE email_id='$email' LIMIT $starting_limit,$results_per_page");
                    $count = mysqli_num_rows($select_post);
                    if ($count == 0) {
                        echo "<h5 class='sean' style='margin-left:40%;margin-top:20px;font-family: 'Fredoka One', cursive;'>you not buy a course!!...</h5>";
                    }
                    while ($row = mysqli_fetch_assoc($select_post)) {
                        $post_title = $row['post_title'];
                        $post_date = $row['date'];
                        $content = $row['content'];
                        $img = $row['post_img'];
                        $post_id = $row['payment_post_id'];
                        $url = $post_id;
                        $enc = $url * 7094952419;
                        $link = '../blog\99?q=' . urlencode(base64_encode($enc));
                ?>
                        <div class="col-lg-4 col-md-6 co_div">
                            <a href="<?php echo $link; ?>">
                                <div class="single_place">
                                    <div class="thumb">
                                        <img src="../course/assets/<?php echo $img; ?>" alt="">
                                        <a href="#" class="prise">Congrats</a>
                                    </div>
                                    <div class="place_info">

                                        <h3 style="font-family: 'Bebas Neue', cursive;"><?php echo $post_title; ?></h3>

                                        <p><?php echo $content; ?></p>
                                        <div class="rating_days d-flex justify-content-between">
                                            <div class="days">
                                                <i class="fa fa-clock-o"></i>
                                                <a href="#"><?php echo $post_date; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                <?php }
                } ?>
                <!-------role is gold------>
                <?php
                if ($_SESSION['zdk'] == 'Gold') {
                    $email = $_SESSION['username'];
                    $select_post = POST::qurey("SELECT * FROM posts WHERE status='publish'");
                    while ($row = mysqli_fetch_assoc($select_post)) {
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];
                        $content = $row['post_content'];
                        $img = $row['post_img'];
                        $post_id = $row['post_id'];
                        $url = $post_id;
                        $enc = $url * 7094952419;
                        $link = '../blog\?q=' . urlencode(base64_encode($enc));
                ?>
                        <div class="col-lg-4 col-md-6">
                            <a href="<?php echo $link; ?>">
                                <div class="single_place">
                                    <div class="thumb">
                                        <img src="../course/assets/<?php echo $img; ?>" alt="">
                                        <a href="#" class="prise">Congrats</a>
                                    </div>
                                    <div class="place_info">

                                        <h3 style="font-family: 'Bebas Neue', cursive;"><?php echo $post_title; ?></h3>

                                        <p><?php echo $content; ?></p>
                                        <div class="rating_days d-flex justify-content-between">
                                            <div class="days">
                                                <i class="far fa-calendar-alt"></i>
                                                <a href="#"><?php echo $post_date; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php }
                } ?>
                <!--role is not admin----->
            </div>
        </div>
    </div>
    <div class="page_div">
        <?php
        for ($page = 1; $page <= $number_of_pages; $page++) {
            if ($select_all_post_count > $results_per_page) {
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == $page) {
                        echo "<a style='text-decoration:none; color:white; border-color:orange; background-color:orange'; class='page' href='?page=$page'>$page</a>";
                    } else {
                        echo "<a style='text-decoration:none;' class='page' href='?page=$page'>$page</a>";
                    }
                } else {
                    echo "<a style='text-decoration:none;' class='page' href='?page=$page'>$page</a>";
                }
            }
        }
        ?>
    </div>
    </div>
    <!-- link that opens popup -->
    <!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script> -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>
    <script src="js/slick.min.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>
</body>

</html>