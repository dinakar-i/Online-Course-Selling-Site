<?Php include '../include/init.php';
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="../img/logo.png">
    <title>Course-page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!--google fonts--->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- CSS here -->
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
    <link rel="stylesheet" href="col.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <!-----search code ajsks method-------------------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body>
    <style>
        ul {
            background-color: #eee;
            cursor: pointer;
        }

        li {
            padding: 12px;
        }
    </style>
    <!-------nav bar------->
    <div class='nav'>
        <a href="../">
            <h4 class="spoof">Spoo<label style="color: #329C8E"> Fcolors</label></h4>
        </a>
        <div class="search">
            <form method="POST">
                <i class="fa fa-search search_icon" aria-hidden="true"></i>
                <input id="country" type="text" name="search" placeholder="Search here..." class="serach_box">
                <input type="submit" class="btn1" value="Search">
            </form>
        </div>
        <div id="countryList" class="se_div">
        </div>
    </div>
    <!--------nav bar ends here------>
    <!-- slider_area_start -->
    <div style="background-color: white;" class="popular_places_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb_70 tit">

                        <!-- <style>.h3:hover { color: rgb(212, 0, 255);}.tit {margin-top: -50px;}
                        </style> -->
                        <!-- <p>Suffered alteration in some form, by injected humour or good day randomised booth anim 8-bit hella wolf moon beard words.</p> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                include '../include/encodes_decodes.php';
                if (isset($_POST['search'])) {
                ?>
                    <?php
                    $search_value = $_POST['search'];
                    $search = mysqli_real_escape_string($conn, $search_value);
                    if ($search == '') {
                        header('location:./');
                    }
                    $post_query = Post::search_fun('posts', 'post_title', $search);
                    $search_count = mysqli_num_rows($post_query);
                    if ($search_count === 0) {
                        echo "<h5 class='sean' style='margin-left:400px;margin-top:20px;font-family: 'Russo One', sans-serif; margin-left:30px;'> No need a search items!!...</h5>";
                    }
                    while ($row = mysqli_fetch_assoc($post_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_price = $row['post_price'];
                        $post_content = $row['post_content'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $url = $post_id;
                        $enc = $url * 7094952419;
                        $link = '../blog\?q=' . urlencode(base64_encode($enc));
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <a href="<?php echo $link; ?>">
                                <div class="single_place">
                                    <div class="thumb">
                                        <img src="../course/assets/<?php echo $post_img; ?>" alt="">
                                        <a href="#" style="text-decoration: none;font-weight:600;" class="prise"><?php
                                                                                                    if ($post_price == 0) {
                                                                                                        echo "Free";
                                                                                                    } else {
                                                                                                        echo 'Rs.' . $post_price;
                                                                                                    }
                                                                                                    ?></a>
                                    </div>
                                    <div class="place_info">

                                        <h3 style="font-family: 'Bebas Neue', cursive;"><?php echo $post_title; ?></h3>

                                        <p><?php echo $post_content; ?></p>
                                        <div class="rating_days d-flex justify-content-between">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <a href="#">(20 Review)</a>
                                            </span>
                                            <div class="days">
                                                <i class="fa fa-clock-o"></i>
                                                <a href="#"><?php echo $post_date; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php } else {
                    $cat_title = $_GET['v'];
                    if ($cat_title == '') {
                        header('location:../');
                    }
                    $cat_str = strval($cat_title);
                    $sql_title = urldecode(base64_decode($cat_str));
                    $loop_decode=Enceodes::loop_decode($sql_title);
                    $main_decode=Enceodes::main_decode($loop_decode);
                    $decode_title = mysqli_real_escape_string($conn, $main_decode);
                    $number = POST::select_all_table('page');
                    $number_fetch = mysqli_fetch_assoc($number);
                    $results_per_page = $number_fetch['page_no'];
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page_we = $_GET['page'];
                        $page = intval($page_we);
                    }
                    $first_result = ($page - 1) * $results_per_page;
                    $post_query = Post::select_table_post_cat_method('posts', 'post_cat', $decode_title);
                    $page_count = mysqli_num_rows($post_query);
                    $qury = POST::qurey("SELECT * FROM posts WHERE post_cat='$decode_title' AND status='publish' LIMIT $first_result,$results_per_page");
                    $cat_count = mysqli_num_rows($qury);
                    if ($cat_count == 0) {
                        echo "<lottie-player src='./css/lf30_editor_63yto21m.json'  background='transparent'  speed='1'  style='width:100%; height100%;'  loop  autoplay></lottie-player>";
                    } else {
                        while ($row = mysqli_fetch_assoc($qury)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_price = $row['post_price'];
                            $post_content = $row['post_content'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_img = $row['post_img'];
                            $url = $post_id;
                            $enc = $url * 7094952419;
                            $link = '../blog\?q=' . urlencode(base64_encode($enc));
    ?>
            <div class="col-lg-4 col-md-6">
                <a href="<?php echo $link; ?>">
                    <div class="single_place">
                        <div class="thumb">
                            <img src="../course/assets/<?php echo $post_img; ?>" alt="">
                            <a href="#" style="text-decoration: none;" class="prise"><?php
                                                                                        if ($post_price == 0) {
                                                                                            echo "Free";
                                                                                        } else {
                                                                                            echo 'Rs.' . $post_price;
                                                                                        }
                                                                                        ?></a>
                        </div>
                        <div class="place_info">

                            <h3 style="font-family: 'Bebas Neue', cursive;cursor: context-menu;"><?php echo $post_title; ?></h3>

                            <p><?php echo $post_content; ?></p>
                            <div class="rating_days d-flex justify-content-between">
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <?php
                                    $select_review = POST::sel_table_by_id('reviews', 'review_post_id', $url);
                                    $count = mysqli_num_rows($select_review);
                                    echo "<a style='text-decoration:none;cursor: context-menu;' href='#'>($count Review)</a>";
                                    ?>
                                </span>
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php
                                    $select_user = POST::sel_table_by_id('payments', 'payment_post_id', $url);
                                    $user_count = mysqli_num_rows($select_user);
                                    echo "<a href='#'>$user_count</a>";
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
                        include '../include/chat.php';
        ?>
        </div>
        </div>

        </div>
        </div>
        <div class='page_div'>

            <?php
                        $fine = ceil($page_count / $results_per_page);
                        for ($page = 1; $page <= $fine; $page++) {
                            if ($results_per_page < $page_count) {
                                if (isset($_GET['page'])) {
                                    if ($_GET['page'] == $page) {
                                        echo "<a style='text-decoration:none; color:white; border-color:orange; background-color:orange'; class='page' href='?v=$cat_title &page=$page'>$page</a>";
                                    } else {
                                        echo "<a style='text-decoration:none;' class='page' href='?v=$cat_title &page=$page'>$page</a>";
                                    }
                                } else {
                                    echo "<a style='text-decoration:none;' class='page' href='?v=$cat_title &page=$page'>$page</a>";
                                }
                            }
                        }

            ?>
        </div>
    <?php } ?>
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
<?php } ?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    $(document).ready(function() {
        $('#country').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#countryList').fadeIn();
                        $('#countryList').html(data);
                    }
                });
            } else {
                $('#countryList').html('');
            }
        });
        $(document).on('click', 'li', function() {
            $('#country').val($(this).text());
            $('#countryList').fadeOut();
        });
    });
</script>